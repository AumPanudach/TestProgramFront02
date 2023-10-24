@extends('layouts.master')
@section('title')
@section('content')
<h1>รายการสินค้า</h1>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title"><strong>รายการ</strong></div>
    </div>
    <!-- form search -->
    <div class="panel-body">
          <form action="{{URL::to('product/search')}}" method="POST" class="form-inline">
            {{csrf_field()}}
            <input type="text" name="q" class="form-control" placeholder="...">
            <button type="submit" class="btn-primary">ค้นหา</button>
          </form>
          <a href="{{URL::to('product/edit')}}" class="btn btn-success pull-right">เพิ่มสินค้า</a>
    </div>
          <!--table my product-->
    <div class="container">
    <table class="table table-bordered bs_table">
        <thead>
          <tr>
            <th>รูปสินค้า</th>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>ประเภท</th>
            <th>คงเหลือ</th>
            <th>ราคาต่อหน่วย</th>
            <th>การทำงาน</th>
         </tr>
        </thead>
         <tbody>
            @foreach ($products as $item)
                <tr>
                    <td><img src="{{$item -> image_url}}" width="50px"></td>
                    <td>{{$item -> code}}</td>
                    <td>{{$item -> name}}</td>
                    <td>{{$item -> category -> name}}</td>
                    <td class="bs_price">{{number_format($item -> stock_qty,0)}}</td>
                    <td class="bs_price">{{number_format($item -> price,2)}}</td>
                    <td class="bs_center">
                        <a href="{{URL::to('product/edit/'.$item->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
                        <a href="#" class="btn btn-danger btn-delete" id-delete="{{$item->id}}"><i class="fa fa-trash"></i> ลบ</a>
                    </td>
                </tr>
            @endforeach
         </tbody>
         <tfoot><tr>
            <th colspan="4">รวม</th>
            <th class="bs_price">{{number_format($products->sum('stock_qty'),0)}}</th>
            <th class ="bs_price">{{number_format($products->sum('price'),2)}}</th></tr>
         </tfoot>
    </table>
    </div>
    <div class="panel-footer">
        <span>แสดงข้อมูลจำนวนสินค้า {{count($products)}}</span>
    </div>
</div>
<div class="container">
    {{ $products->links() }}
</div>
<script>
    $('.btn-delete').on('click', function() { if(confirm("คุณต้องการลบข้อมูลจริงหรือไม่?")){
        var url = "{{ URL::to('product/remove') }}" + '/' + $(this).attr('id-delete');
        window.location.href = url;       
    }
    });
</script>
@endsection
