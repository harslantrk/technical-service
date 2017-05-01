<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Product;
use App\ServicePayment;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;
use Auth;
use Carbon\Carbon;
use DB;
use Session;
use Laracasts\Flash\Flash;
use App\Helpers\Helper;

class ServiceController extends Controller
{
    //Hizmetlerimiz Listeleme
    public function __construct(Request $request)
    {
        $url = $request->path();
        Helper::sessionReload();
        $sess= Helper::shout($url);
        $this->read=$sess['r'];
        $this->update=$sess['u'];
        $this->add=$sess['a'];
        $this->delete=$sess['d'];
        $this->sess=$sess;
    }
    public function index(){
        if($this->read==0){
            return redirect()->action('Admin\HomeController@index');
        }
    	$services = Service::where('status',1)->get();

    	return view('admin.service.index', [
    	    'services' => $services,
            'deleg' => $this->sess
        ]);

    }
    public function create(){
    	if($this->read==0 || $this->add==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $customers = Customer::where('status',1)->get();
        $products = Product::where('status',1)->get();
    	return view('admin.service.create',[
    	    'customers' => $customers,
            'products' => $products
        ]);
    }

    public function save(Request $request){
    	$data =$request->all();
    	$data['status'] = 1;
    	$data['user_id'] = Auth::user()->id;
    	Service::create($data);
    	/*echo '<pre>';
    	print_r($data);
    	die();*/
    	return redirect('/admin/service');
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();
        Service::find($id)->update($data);
        return redirect('/admin/service');
    }

    public function edit($id)
    {
        if($this->read==0 || $this->update==0){
            return redirect()->back();
        }
        $service = Service::where('id',$id)->first();
        $customers = Customer::where('status',1)->get();
        $products = Product::where('status',1)->get();
        return view('admin.service.edit',[
            'service' => $service,
            'customers' => $customers,
            'products' => $products
        ]);
    }

    public function delete($id) {
    	if ($this->read==0 || $this->delete==0) {
    		return redirect()->action('Admin\HomeController@index');
    	}
    	$services=Service::find($id);
    	$services->status = 0;
    	$services->save();
        return redirect('/admin/service');
    }
    public function serviceClose($id){
        $service = Service::find($id);
        $service['status'] = 2;
        $service->save();
        return redirect('/admin/service');
    }
    public function PaymentView($id){
        $service_payments = ServicePayment::where('service_id',$id)->get();
        $service = Service::where('id',$id)->first();
        $products = Product::where('status',1)->where('stock','>',0)->get();

        return view('admin.service.paymentModal',[
            'service_id' => $id,
            'products' => $products,
            'service' => $service,
            'service_payments' => $service_payments
        ]);
    }
    public function AddPayment(Request $request,$id){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['service_id'] = $id;

        $stock = Product::where('id',$data['product_id'])->first();
        $stock->stock = $stock->stock - $data['quantity'];
        $stock->save();

        $guncelle = ServicePayment::where('service_id',$id)->where('product_id',$data['product_id'])->first();
        if ($guncelle) {
            $guncelle->quantity = $guncelle->quantity + $data['quantity'];
            $guncelle->kdv = $guncelle->kdv + $data['kdv'];
            $guncelle->total = $guncelle->total + $data['total'];
            $guncelle->save();
            //ServicePayment::find($guncelle->id)->update($guncelle);
        }else{
            ServicePayment::create($data);
        }
        return redirect()->back();
    }

    public function deletePayment($id)
    {
        $sPayment = ServicePayment::where('id',$id)->first();

        $pQuantity = $sPayment->quantity;
        $pId = $sPayment->product_id;

        ServicePayment::destroy($id);
        $product = Product::where('id',$pId)->first();
        $product->stock = $product->stock + $pQuantity;
        $product->save();
        //Product::where('id',$pId)->update(['quantity' => $pQuantity]);
        return redirect()->back();
    }
    public function show($id)
    {
        if($this->read==0){
            return redirect()->back();
        }
        $service_payments = ServicePayment::where('service_id',$id)->get();
        $service = Service::where('id',$id)->first();
        $customers = Customer::where('status',1)->get();
        $products = Product::where('status',1)->get();
        return view('admin.service.show',[
            'service' => $service,
            'customers' => $customers,
            'products' => $products,
            'service_payments' => $service_payments
        ]);
    }

    public function excelDownload($id)
    {
        $service = Service::where('id',$id)->first();

        Excel::create(Carbon::now()->format('d/m/Y').' Servis Çıktısı',function ($excel) use($service){
            $excel->sheet('Servis',function ($sheet) use($service){

                $row = 9;
                $sheet->setAutoSize(true);

                $sheet->mergeCells('A1:E1');
                $sheet->row(1,[$service->id.' numaralı Servis Bilgi Formu']);

                $sheet->setBorder('A2:A6','thin');
                $sheet->cells('A1:E6',function ($cells){
                    $cells->setFont([
                        'family' => 'Calibri',
                        'size'   => '16',
                        'bold'   => true
                    ]);
                });
                for ($i=2;$i<7;$i++) {
                    $sheet->mergeCells('B'.$i.':E'.$i);
                }
                $sheet->row(2,['Müşteri',$service->customer->name.' '.$service->customer->surname]);
                $sheet->row(3,['Gelen Ürün',$service->product->name]);
                $sheet->row(4,['Bildirilen Hata',$service->customer_fault]);
                $sheet->row(6,['Yapılan İşlem',$service->process]);
                if ($service->warranty == 1) {
                    $sheet->row(5,['Garanti','Var']);
                }else{
                    $sheet->row(5,['Garanti','Yok']);
                }
                $sheet->cells('A8:E8',function ($cells){
                    $cells->setBackground('#e69988');
                    $cells->setFont([
                        'family' => 'Calibri',
                        'size'   => '16',
                        'bold'   => true
                    ]);
                    $cells->setAlignment('center');
                });
                $sheet->setBorder('A8:E8','thin');
                $sheet->row(8,['Ürün Adı','Adet','Birim Fiyat',' KDV %(18)','Toplam']);

                $servicePayments = ServicePayment::where('service_id',$service->id)->get();
                $total = 0;
                foreach ($servicePayments as $servicePayment) {
                    $total = $total + $servicePayment->total;
                    $sheet->row($row,[
                        $servicePayment->product->name,
                        $servicePayment->quantity,
                        $servicePayment->product->out_price,
                        $servicePayment->kdv,
                        $servicePayment->total
                    ]);
                    $row++;
                }
                $sheet->row($row+1,['Genel Toplam',' ',' ',' ',$total]);

            });
        })->export('xls');
    }

    public function AllExcel()
    {
        $services = Service::where('status',1)->get();

        Excel::create(Carbon::now()->format('d/m/Y').' Tüm Servisler',function ($excel) use($services){
            $excel->sheet('Servisler', function ($sheet) use($services){

                $row = 2;
                $sheet->cells('A1:H1',function ($cells){
                    $cells->setBackground('#67A8CE');
                    $cells->setFont([
                        'family' => 'Calibri',
                        'size'   => '16',
                        'bold'   => true
                    ]);
                    $cells->setAlignment('center');
                });
                $sheet->setBorder('A1:H1','thin');
                $sheet->row(1,['Müşteri','Ürün','Bildirilen Problem','Yapılan İşlem','Öneri','Emanet','Garanti','Geliş Tarihi']);
                $sheet->setAutoFilter();

                $warranty = "";
                foreach ($services as $service) {
                    if ($service->warranty == 1) {
                        $warranty = 'Var';
                    }else{
                        $warranty = 'Yok';
                    }
                    $sheet->row($row,[
                        $service->customer->name,
                        $service->product->name,
                        $service->customer_fault,
                        $service->process,
                        $service->process_proposal,
                        $service->deposit,
                        $warranty,
                        $service->created_at
                    ]);
                    $row++;
                }
            });
        })->export('xls');
    }
}
