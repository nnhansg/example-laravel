@extends('admin.layouts.default')

@section('title')
   Add new user 123 :: @parent
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <h1 class="page-header">Add new user</h1>
    <div class="row">
      <div class="col-md-12">
        <div id="alert-summary" class="alert hide" role="alert"></div>
      </div>
    </div>
    <form id="add-new-user-form" class="form-horizontal" role="form">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="name" placeholder="Name" autofocus="">
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          <div id="alert-email" class="alert-text hide"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@stop

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      //
      $('#email').change(function(){
        var checkEmailUrl = "/admin/users/check-email-exist";
        //var pageUrl = "https://graph.facebook.com/10150232496792613";

        // Check email exist
        $.post(checkEmailUrl,
          {
            email: $(this).val()
          },
          function (data) {
            //console.log("Data123: " + data.msg + "\nStatus: " + status);
            $('#alert-email').html(data.msg).removeClass('hide');
          })
        .done(function() {
          //alert( "second success" );
        })
        .fail(function() {
          alert( "error" );
        });

        // $.ajax({
        //   type: 'GET',
        //   url: pageUrl,
        //   data: "email=" + $(this).val(),
        //   dataType: 'jsonp',
        //   success:function(response){
        //     console.log(data.toSource());
        //   }
        // });

        // $.getJSON(pageUrl, function(data){
        //   console.log(data.toSource());
        // });
      });

      //
      $("#add-new-user-form").submit(function() {
        var saveNewUserUrl = "/admin/users/add"; //"/admin/users/add"; alert('{{{ Request::url() }}}');

        // Save new user
        $.post(saveNewUserUrl,
          $(this).serialize(),
          function (data) {
            if (data.result == 'true') {
              $('#alert-summary').html(data.msg).removeClass('hide').removeClass('alert-danger').addClass('alert-success');
            } else {
              $('#alert-summary').html(data.msg).removeClass('hide').removeClass('alert-success').addClass('alert-danger');
            }
          })
        .done(function() {
          //
        })
        .fail(function() {
          $('#alert-summary').html("Some errors. Please try again or contact website's administrator.").removeClass('hide').removeClass('alert-success').addClass('alert-danger');
        });

        event.preventDefault();
      });
    });
  </script>
@stop