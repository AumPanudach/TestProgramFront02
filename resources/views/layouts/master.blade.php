
<!DOCTYPE html>
<html lang="en">
<head>
  <?php if(!Session::has('cart_items')){
          Session::put('cart_items',[]);
  } ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',"Bikeshop | จำหน่ายอะไหล่จักรยานยน")</title>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/stye.css')}}">
    <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('js/angular.min.js')}}"></script>
</head>
<body>
    <script src="{{asset('vendor/toastr/toastr.min.js')}}"></script>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">BikeShop</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
        <li><a href="{{URL::to('home')}}">หน้าแรก</a></li>@guest
        @else    
        <li><a href="{{URL::to('product')}}">ข้อมูลสินค้า</a></li>
        <li><a href="#">รายงาน</a></li>
        <li><a href="{{URL::to('category')}}">ประเภทสินค้า</a></li>@endguest
        </ul>
        <ul class="nav navbar-nav navbar-right">@guest
          <li><a href="{{URL::to('cart/view')}}"><i class="fa fa-shopping-cart"></i> ตะกร้า
          <span class="label label-danger">
          {!! count(Session::get('cart_items')) !!}</span></a></li>
          <li><a href="{{route('login')}}">ล็อคอิน</a></li>
          <li><a href="{{route('register')}}">ลงทะเบียน</a></li>
        @else
        <li><a href="{{URL::to('cart/view')}}"><i class="fa fa-shopping-cart"></i> ตะกร้า
          <span class="label label-danger">
          {!! count(Session::get('cart_items')) !!}</span></a></li>
          <li><a href="#">{{Auth::user()->name}}</a></li>
          <li><a href="{{URL::to('logout')}}">ออกจากระบบ</a></li>
      
      </ul>
        @endguest
        </div>
        </div>
        </nav>@yield('content')
        @if(session('msg'))
          @if(session('ok'))
            <script>toastr.success("{{ session('msg') }}")</script>
          @else
               <script>toastr.error("{{ session('msg') }}")</script>
          @endif
        @endif
        <br>
        ภานุเดช คงสมบูรณ์ 6406021611026
</body>
</html>