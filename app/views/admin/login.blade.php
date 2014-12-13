@extends('admin.layouts.default')

@section('title')
   Login in :: @parent
@stop

@section('content')
<div class="row">
   <div class="login-panel panel panel-default">
      <div class="panel-heading">
         <h3 class="panel-title">Login - Admin Shop Online</h3>
      </div>
      <div class="panel-body">
        <div class="alert alert-danger alert-dismissible {{ (Session::get('alert_danger') != null) ? '' : 'hide' }}" role="alert">
          <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
          </button>
          {{{ Session::get('alert_danger') }}}
        </div>
        <form role="form" method="post" action="">
           <fieldset>
               <div class="form-group">
                   <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" value="{{{ $remember['email'] }}}">
               </div>
               <div class="form-group">
                   <input class="form-control" placeholder="Password" name="password" type="password" value="{{{ $remember['password'] }}}">
               </div>
               <div class="checkbox">
                   <label>
                       <input name="remember" type="checkbox" value="Remember Me" {{{ ($remember['remember']) ? 'checked' : '' }}}>Remember Me
                   </label>
               </div>
               <!-- Change this to a button or input when using this as a form -->
               <input type="submit" class="btn btn-sm btn-success" value="Login" />
           </fieldset>
        </form>
      </div>
   </div>
</div>
@stop

@section('scripts')
  <script type="text/javascript">
    $( document ).ready(function() {
      //alert('good');
    });
  </script>
@stop