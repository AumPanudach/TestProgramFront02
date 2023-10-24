@extends('layouts.master')
@section('title') Bikeshop | ข้อมูลประเภทสินค้า @stop
@section('content')

<h1>รายการประเภทสินค้า</h1>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title"><strong>รายการ</strong></div>
    </div>
    <!-- form search -->
    <div class="panel-body">
          <form action="{{URL::to('category/search')}}" method="POST" class="form-inline">
            {{csrf_field()}}
            <input type="text" name="q" class="form-control" placeholder="...">
            <button type="submit" class="btn-primary">ค้นหา</button>
          </form>
          <a href="{{URL::to('category/edit')}}" class="btn btn-success pull-right">เพิ่มสินค้า</a>
    </div>
          <!--table my product-->
    <div class="container">
    <table class="table table-bordered bs_table">
        <thead>
          <tr>
            <th>ชื่อประเภทสินค้า</th>
         </tr>
        </thead>
         <tbody>
            @foreach ($category as $item)
                <tr>
                    <td>{{$item -> name}}</td>
                    <td class="bs_center">
                        <a href="{{URL::to('category/edit/'.$item->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
                        <a href="#" class="btn btn-danger btn-delete" id-delete="{{$item->id}}"><i class="fa fa-trash"></i> ลบ</a>
                    </td>
                </tr>
            @endforeach
         </tbody>
    </table>
    <tfoot>
        <div class="panel-footer">
            <span>แสดงข้อมูลจำนวนสินค้า {{count($category)}}</span>
        </div></tfoot>
    </div>
</div>
<div class="container">
    {{ $category->links() }}
</div>
<script>
    $('.btn-delete').on('click', function() { if(confirm("คุณต้องการลบข้อมูลจริงหรือไม่?")){
        var url = "{{ URL::to('category/remove') }}" + '/' + $(this).attr('id-delete');
        window.location.href = url;       
    }
    });
</script>
@endsection
