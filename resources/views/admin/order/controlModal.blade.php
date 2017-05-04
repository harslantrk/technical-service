<div class="col-sm-12">
    <div class="box box-danger">
        <div class="box-body">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <td>Ürün</td>
                        <td>Gerekli Adet</td>
                        <td>Stok</td>
                        <td>Kalan Adet</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($joinings as $joining)
                        <?php $total = ($quantity * $joining->quantity);?>
                        @if($total > $joining->stock)
                            <tr class="text-red nothing text-bold">
                        @else
                            <tr class="text-success text-bold">
                                @endif
                                <td>{{$joining->name}}</td>
                                <td>{{$total}}</td>
                                <td>{{$joining->stock}}</td>
                                <td>{{$joining->stock - $total}} Adet</td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>