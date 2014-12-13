@extends('admin.layouts.default')

@section('title')
   Users Management :: @parent
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
          <h1>
            <a href="{{{ URL::to('admin/users/add') }}}" class="btn btn-primary">Add new</a>
          </h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="alert-summary-list-users" class="alert hide" role="alert"></div>
      </div>
    </div>
     <div class="login-panel panel panel-default">
        <div class="panel-heading">
           <h3 class="panel-title">Users Management - Admin Shop Online</h3>
        </div>
        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Email</th>
              <th>Name</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
  @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->created_at }}</td>
              <td>{{ $user->updated_at }}</td>
              <td>
                <a class="btn btn-primary edit-button" data-toggle="modal" data-target="#editModal" data-id="{{ $user->id }}">
                  <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
    @if (Session::get('user_id') != $user->id)
                <a class="btn btn-danger delete-button" data-toggle="modal" data-target="#confirmModal" data-id="{{ $user->id }}">
                  <i class="glyphicon glyphicon-trash"></i> Delete
                </a>
    @endif
              </td>
            </tr>
  @endforeach
          </tbody>
        </table>

        <!-- Models -->
        <div class="modal fade" id="editModal" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="editModalLabel">Edit user</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div id="alert-summary" class="alert hide" role="alert"></div>
                  </div>
                </div>
                <form id="add-edit-user-form" class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                      <input type="hidden"id="id" name="id">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Name" autofocus="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" disabled>
                      <div id="alert-email" class="alert-text hide"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="save-button" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Confirm delete -->
        <div id="confirmModal" class="modal fade" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="confirmModalLabel">Delete Parmanently</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    Are you sure?
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="confirm-button">Confirm</button>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
              </div>
            </div>
          </div>
        </div>
     </div>

     <div class="row">
      <div class="col-md-12">
        <form id="importUserForm" role="form" method="post" enctype="multipart/form-data" action="{{{ URL::to('admin/users/import-users') }}}">
          <div class="form-group">
            <label for="fileInput">File input</label>
            <input type="file" id="fileInput" name="fileInput" />
            <p class="help-block">Choose a file (*.xls, *.csv).</p>
            <p class="help-block">Today {{{ time() }}}</p>
            <p class="help-block">Upload file to path: {{{ public_path() . '/imports/' }}}</p>
          </div>
          <button type="submit" class="btn btn-primary">Upload file</button>
        </form>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      //
      $('.edit-button').click(function() {
        var user_id = $(this).attr('data-id');
        var editUserUrl = "/admin/users/edit";

        $.post(editUserUrl,
          { id: user_id },
          function (data) {
            if (data.result == 'true') {
              //$('#alert-summary').html(data.toSource()).removeClass('hide').removeClass('alert-danger').addClass('alert-success');
              $('#id').val(data.obj.id);
              $('#name').val(data.obj.name);
              $('#email').val(data.obj.email);
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
      });

      //
      $('.delete-button').click(function() {
        var user_id = $(this).attr('data-id');
        var deleteUserUrl = "/admin/users/delete";

        // $('#confirmModal').on('show.bs.modal', function (e) {
        //     $message = $(e.relatedTarget).attr('data-message');
        //     $(this).find('.modal-body p').text($message);
        //     $title = $(e.relatedTarget).attr('data-title');
        //     $(this).find('.modal-title').text($title);

        //     // Pass form reference to modal for submission on yes/ok
        //     // var form = $(e.relatedTarget).closest('form');
        //     // $(this).find('.modal-footer #confirm').data('form', form);
        // });

        <!-- Form confirm (yes/ok) handler, submits form -->
        $('#confirmModal').find('.modal-footer #confirm-button').on('click', function(){
            //$(this).data('form').submit();
            //alert(user_id);
            $.post(deleteUserUrl,
              { id: user_id },
              function (data) {
                if (data.result == 'true') {
                  $('#alert-summary-list-users').html(data.msg).removeClass('hide').removeClass('alert-danger').addClass('alert-success');
                } else {
                  $('#alert-summary-list-users').html(data.msg).removeClass('hide').removeClass('alert-success').addClass('alert-danger');
                }
              })
            .done(function() {
              //
            })
            .fail(function() {
              $('#alert-summary-list-users').html("Some errors. Please try again or contact website's administrator.").removeClass('hide').removeClass('alert-success').addClass('alert-danger');
            });
        });
      });

      //
      $("#save-button").click(function() {
        var saveEditUserUrl = "/admin/users/edit/save";

        // Save new user
        $.post(saveEditUserUrl,
          $('#add-edit-user-form').serialize(),
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
      });
    });
  </script>
@stop