@extends('layouts.master')
@section('title') BikeShop | เพิ่มข้อมูลสินค้า @stop
@section('content')
@if ($errors->any())
   <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
   </div>
@endif
<h1>เพิ่มประเภทสินค้า</h1>
<ul class="breadcrumb">
    <li><a href="{{URL::to('category')}}">หน้าแรก</a></li>
    <li class="active">เพิ่มประเภทสินค้า</li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title"><strong>ข้อมูลประเภทสินค้า</strong></div>
    </div>
<div class="panel-body">
{!! Form::open(array('action' => 'App\Http\Controllers\CategoryController@insert', 'method'=>'post','enctype' => 'multipart/form-data'))!!}
<input type="hidden" name="id">
<table>
    <tr>
        <td>{{Form::label('name','ชื่อประเภทสินค้า')}}</td>
        <td>{{Form::text('name',Request::old('name'),['class'=>'form-control'])}}</td>
    </tr>
    </tr>
</table>
</div>
<div class="panel-footer">
<button type="reset" class="btn btn-danger">ยกเลิก</button>
<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
</div>
</div>
{!! Form::close()!!}
@endsection