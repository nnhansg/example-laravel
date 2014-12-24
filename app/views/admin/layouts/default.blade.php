<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>
        @section('title')
          Admin - Shop Online 123456
        @show
      </title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      {{ HTML::style('css/bootstrap.min.css') }}
      <style>
       body {
           padding-top: 50px;
           padding-bottom: 20px;
       }
      </style>
      {{ HTML::style('css/bootstrap-theme.min.css') }}
      {{ HTML::style('css/main.css') }}

      {{ HTML::script('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }}
   </head>
   <body>
      <!--[if lt IE 7]>
         <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->

      <div class="container">
        <div class="row">
          <div class="col-md-12">
            @if (Session::get('user_id') != null)
            <div class="col-md-2">
              <div class="sidebar-nav">
                <div class="row">
                  <ul class="nav nav-list">
                    <li class="nav-header">Admin Menu</li>
                    <li><a href="{{{ URL::to('admin') }}}">Dashboard</a></li>
                    <li>
                      <a href="{{{ URL::to('admin/users') }}}">Users</a>
                      <ul class="nav nav-list">
                        <li><a href="{{{ URL::to('admin/users') }}}">All Users</a></li>
                        <li><a href="{{{ URL::to('admin/users/add') }}}">Add new</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="{{{ URL::to('admin/products') }}}">Products</a>
                      <ul class="nav nav-list">
                        <li><a href="{{{ URL::to('admin/products') }}}">All Products</a></li>
                        <li><a href="{{{ URL::to('admin/products/add') }}}">Add new</a></li>
                      </ul>
                    </li>
                    <li><a href="#">Settings</a></li>
                    <li>
                      <form role="form" method="post" action="{{{ URL::to('admin/logout') }}}">
                        <input type="submit" class="btn btn-sm btn-success" value="Log out" />
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            @endif
            <div class="{{{ (Session::get('user_id') != null) ? 'col-md-10' : 'col-md-6 col-md-offset-3' }}}">
              @yield('content')
            </div>
          </div>
        </div>
      </div>

      {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
      <script src=""></script>
      <script>window.jQuery || document.write('<script src="{{{ asset('js/vendor/jquery-1.11.1.min.js') }}}"><\/script>')</script>
      {{ HTML::script('js/vendor/bootstrap.min.js') }}
      {{ HTML::script('js/plugins.js') }}
      {{ HTML::script('js/main.js') }}

      @yield('scripts')
      <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
   </body>
</html>
