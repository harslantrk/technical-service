<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Comment;
use App\Http\Requests;
use App\Joining;
use App\Product_Type;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Exception;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Product;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
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
    //Tüm Ürünler
    public function index(){
        if($this->read==0){
            return redirect()->action('Admin\HomeController@index');
        }
    	//$products = Product::all();
        $products = Product::where('status',1)->orderBy('id','desc')->get();
    	return view('admin.product.index',[
    	    'products' => $products,
            'deleg' => $this->sess
        ]);
    }
    //Yeni Ürünler
    public function create(){
        if($this->read==0 || $this->add==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $brands = Brand::where('status',1)->get();
        $product_types = Product_Type::where('status',1)->get();
    	return view('admin.product.create',[
    	    'brands' => $brands,
            'product_types' => $product_types
        ]);
    }
    public function ImagePostSave(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/uploads/');
        $image->move($destinationPath,$input['imagename']);

        $user = Product::findOrFail($request->id);
        $user->image ='/uploads/'.$input['imagename'];
        $user->save();

        return redirect()->back();
    }

    //Yeni Ürün Oluşturma Fonksiyonu
    public function save(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 1;
        $product = Product::create($data);
        /*echo '<pre>';
        print_r($product->id);
        die();*/
    	return redirect('/admin/product/edit/'.$product->id);
    }

    public function edit(Request $request){
        if($this->read==0 || $this->update==0){
            return redirect()->back();
        }
        $brands = Brand::where('status',1)->get();
        $product_types = Product_Type::where('status',1)->get();
    	$id = $request->id;
    	$product = Product::where('id',$id)->first();
    	$product_joins = DB::table('joining')
                            ->join('product','product.id','=','joining.twoproduct_id')
                            ->where('joining.product_id',$id)
                            ->select('joining.*','product.name')->get();

    	return view('admin.product.edit',[
    	    'product' => $product,
            'brands' => $brands,
            'product_types' => $product_types,
            'product_joins' => $product_joins
        ]);
    }
    
    // Ürün Güncelleme Fonksiyonu
    public function update(Request $request,$id){
        $data = $request->all();
        Product::find($id)->update($data);
    	return redirect('/admin/product');
    }
    // Ürün Silme Fonksiyonu
    public function delete(Request $request){
        if ($this->read==0 || $this->delete==0) {
            return redirect()->action('Admin\HomeController@index');
        }
    	$id = $request->id;
    	$productData = Product::find($id);
		$productData->status = 0;
		$productData->save();
		return redirect('/admin/product');
    }

    public function show($id)
    {
        $products = Product::where('id',$id)->first();
        $brands = Brand::where('status',1)->get();
        $product_types = Product_Type::where('status',1)->get();
        $comments = Comment::where('status',1)->where('product_id',$id)->get();

        /*echo '<pre>';
        print_r($comments);
        die();*/

        return view('admin.product.show',[
            'products' => $products,
            'brands' => $brands,
            'product_types' => $product_types,
            'comments'=>$comments
        ]);
    }

    public function commentThoughtSave(Request $request)
    {
        $data = $request->all();
        $count = Comment::where('id',$data['comment_id'])->first();
        $usersCom = $count->users_comment;
        $usersCom = json_decode($usersCom);
        foreach($usersCom as $key=>$value)
        {
            $newUsersCom[$key] = $value;
        }
        $newUsersCom[Auth::user()->id] = Auth::user()->id;
        /*echo '<pre>';
        print_r($newUsersCom);
        die();*/
        if ($data['thought']==0) {
            Comment::where('id',$data['comment_id'])->update([
                'negative_comment' => $count->negative_comment+1,
                'users_comment' => json_encode($newUsersCom)
            ]);
        }else{
            Comment::where('id',$data['comment_id'])->update([
                'positive_comment' => $count->positive_comment+1,
                'users_comment' => json_encode($newUsersCom)
            ]);
        }
        return redirect()->back();
    }

    public function commentSave(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['users_comment'] ='{}';
        Comment::create($data);

        return redirect()->back();
    }

    public function commentCheck($id)
    {
        Comment::where('id',$id)->update(['status'=>1]);

        return redirect()->back();
    }

    public function commentUnCheck($id)
    {
        Comment::where('id',$id)->update(['status'=>0]);

        return redirect()->back();
    }

    public function AllProductExcelExport()
    {
        $products = Product::where('status',1)->get();
        Excel::create(Carbon::now()->format('d / m / Y').' Ürünler', function($excel) use($products) {

            $excel->sheet('Ürünler', function($sheet) use($products) {

                $row = 2;
                $sheet->setAutoSize(true);
                $sheet->cells('A1:I1',function ($cells){
                    $cells->setBackground('#e69988');
                    $cells->setFont([
                        'family' => 'Calibri',
                        'size'   => '16',
                        'bold'   => true
                    ]);
                    $cells->setAlignment('center');
                });
                $sheet->setBorder('A1:I1','thin');
                $sheet->row(1,['Ürün Adı','Marka','Ürün Türü',' Açıklama','Stok','Giriş Fiyatı','Çıkış Fiyatı','Girişi Yapan','Giriş Tarihi']);
                $sheet->setColumnFormat([
                    'E' => '0',
                    'F' => '0',
                    'G' => '0',
                    'I' => 'd/m/y h:mm'
                ]);

                foreach ($products as $product) {
                    $sheet->row($row,[
                        $product->name,
                        $product->brand->brand,
                        $product->product_type->product_type,
                        $product->detail,
                        $product->stock,
                        $product->in_price,
                        $product->out_price,
                        $product->user->name,
                        Carbon::parse($product->created_at)->format('d/m/Y H:i:s')
                    ]);
                    $row++;
                }

            });

        })->export('xls');
    }

    public function ExcelExportText($text)
    {
        $products = DB::table('product')
            ->join('brand','product.brand_id','=','brand.id')
            ->join('product_type','product.product_type_id','=','product_type.id')
            ->join('users','product.user_id','=','users.id')
            ->orWhere('product.name','like','%'.$text.'%')->orWhere('brand.brand','like','%'.$text.'%')
            ->orWhere('product_type.product_type','like','%'.$text.'%')
            ->where('product.status',1)
            ->select('product.*','brand.brand','product_type.product_type','users.name as uname')
            ->get();

        Excel::create(Carbon::now()->format('d / m / Y').' '.$text.' Ürünler', function($excel) use($products) {

            $excel->sheet('Ürünler', function($sheet) use($products) {

                $row = 2;
                $sheet->setAutoSize(true);
                $sheet->cells('A1:I1',function ($cells){
                    $cells->setBackground('#e69988');
                    $cells->setFont([
                        'family' => 'Calibri',
                        'size'   => '16',
                        'bold'   => true
                    ]);
                    $cells->setAlignment('center');
                });
                $sheet->setBorder('A1:I1','thin');
                $sheet->row(1,['Ürün Adı','Marka','Ürün Türü',' Açıklama','Stok','Giriş Fiyatı','Çıkış Fiyatı','Girişi Yapan','Giriş Tarihi']);
                $sheet->setColumnFormat([
                    'E' => '0',
                    'F' => '0',
                    'G' => '0',
                    'I' => 'd/m/y h:mm'
                ]);
                foreach ($products as $product) {
                    $sheet->row($row,[
                        $product->name,
                        $product->brand,
                        $product->product_type,
                        $product->detail,
                        $product->stock,
                        $product->in_price,
                        $product->out_price,
                        $product->uname,
                        Carbon::parse($product->created_at)->format('d/m/Y H:i:s')
                    ]);
                    $row++;
                }
            });

        })->export('xls');
    }

    public function ExcelImport(Request $request)
    {
        if ($request->hasFile('excelImport')) {
            $path = $request->file('excelImport')->getRealPath();

            $data = Excel::load($path,function ($reader){})->get();

            if (!empty($data) && $data->count()) {
                foreach ($data->toArray() as $key => $value) {
                    if(!empty($value)){
                        foreach ($value as $v) {
                            $inserts[] = [
                                'name' => $v['urun_adi'],
                                'brand_id' => $v['marka'],
                                'product_type_id' => $v['urun_turu'],
                                'user_id' => $v['kullanici'],
                                'detail' => $v['aciklama'],
                                'stock' => $v['stok'],
                                'in_price' => $v['gelis'],
                                'out_price' => $v['cikis'],
                                'status' => 1
                            ];
                        }
                    }
                }
                echo '<pre>';
                print_r($inserts);
                die();
                foreach ($inserts as $insert) {
                    $insert = (object)$insert;

                    $user = User::where('name','like','%'.$insert->user_id.'%')->first();
                    if (count($user)) {
                        $insert->user_id = $user->id;
                    }
                    $Bcontrol = Brand::where('brand','like','%'.$insert->brand_id.'%')->first();
                    if (count($Bcontrol)) {
                        $insert->brand_id = $Bcontrol->id;
                    }else{
                        $brand = new Brand();
                        $brand->brand = $insert->brand_id;
                        $brand->user_id = $insert->user_id;
                        $brand->status = 1;
                        $brand->save();
                        $insert->brand_id = $brand->id;
                    }

                    $PTControl = Product_Type::where('product_type','like','%'.$insert->product_type_id.'%')->first();
                    if (count($PTControl)) {
                        $insert->product_type_id = $PTControl->id;
                    } else {
                        $product_type = new Product_Type();
                        $product_type->product_type = $insert->product_type_id;
                        $product_type->user_id = $insert->user_id;
                        $product_type->status = 1;
                        $product_type->save();

                        $insert->product_type_id =$product_type->id;
                    }

                    $PControl = Product::where('name','like','%'.$insert->name.'%')->first();
                    if (count($PControl)) {
                    }else{
                        $product = new Product();
                        $product->name = $insert->name;
                        $product->brand_id = $insert->brand_id;
                        $product->product_type_id = $insert->product_type_id;
                        $product->user_id = $insert->user_id;
                        $product->detail = $insert->detail;
                        $product->stock = $insert->stock;
                        $product->in_price = $insert->in_price;
                        $product->out_price = $insert->out_price;
                        $product->status = $insert->status;
                        $product->save();
                    }
                }
                return redirect()->back();

                /*echo '<pre>';
                print_r($insert);
                die();*/

            }
        }
    }

    public function joinCreate(Request $request)
    {
        $data = $request->all();
        $product_id = $data['product_id'];
        $products = Product::where('status',1)->where('id','!=',$product_id)->get();
        $product_one = Product::where('status',1)->where('id',$product_id)->first();

        return view('admin.product.joining',[
            'products' => $products,
            'product_one' => $product_one
        ]);
    }

    public function joinSave(Request $request)
    {
        $data = $request->all();
        try {
            Joining::create($data);
            Session::flash('success','Kayıt Başarılı');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error',$e->getMessage());
            return redirect()->back();
        }
    }

    public function joinDelete($id)
    {
        try {
            Joining::find($id)->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error',$e->getMessage());
            return redirect()->back();
        }
    }

}
