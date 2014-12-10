@extends('admin.layouts.default')

@section('title')
   Dashboard :: @parent
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
     <div class="login-panel panel panel-default">
        <div class="panel-heading">
           <h3 class="panel-title">Dashboard - Admin Shop Online</h3>
        </div>
        <div class="panel-body">
           <!-- Change this to a button or input when using this as a form -->
           <a href="{{{ URL::to('admin/users') }}}" class="btn btn-primary btn-lg" role="button">Users Management</a>
           <a href="{{{ URL::to('admin/products') }}}" class="btn btn-primary btn-lg" role="button">Products Management</a>
        </div>
     </div>
  </div>
</div>
@stop