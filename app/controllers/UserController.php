<?php

class UserController extends BaseController {
    ///
    public function getLogin() {
        $userId = Session::get('user_id');

        if ($userId != null) {
            return Redirect::to('admin/dashboard');
        }

        $remember = Cookie::get('login_input');

        return View::make('admin/login', array('remember' => $remember));
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin() {
        $input = array(
            'email'    => Input::get('email'),
            'password' => Input::get('password'),
            'remember' => Input::get('remember'),
        );

        $remember = null;

        if ($input['remember'] != null) {
            Cookie::queue('login_input', $input);
        } else {
            //Cookie::forget('login_input');
        }

        $model = User::whereRaw('email = ?', array($input['email']))->first();

        if ($model != null && Hash::check($input['password'], $model->password)) {
            Session::put('user_id', $model->id);

            return Redirect::to('admin/dashboard');
        } else {
            $alert_danger = 'Username/Password is incorrect.';

            return Redirect::back()->with('alert_danger', $alert_danger);
        }
    }

    ///
    public function postLogout() {
        Session::flush();

        return Redirect::to('admin/login');
    }

    ///
    public function getAll() {
        $userId = Session::get('user_id');

        if ($userId == null) {
            return Redirect::to('admin/login');
        }

        $users = User::all();

        return View::make('admin/users/index',  array('users' => $users));
    }

    ///
    public function getAdd() {
        $userId = Session::get('user_id');

        if ($userId == null) {
            return Redirect::to('admin/login');
        }

        return View::make('admin/users/add_edit');
    }

    ///
    public function postCheckEmailExist() {
        $model = User::whereRaw('email = ?', array(Input::get('email')))->first();

        $response = array(
            'result' => 'true',
            'msg' => 'Someone already has that email. Try another?',
        );

        if ($model == null) {
            $response = array(
                'result' => 'false',
                'msg' => "That's good",
            );
        }

        return Response::json($response);
    }

    ///
    public function postAdd() {
        $userId = Session::get('user_id');

        if ($userId == null) {
            return Redirect::to('admin/login');
        }

        $input = array(
            'name'    => Input::get('name'),
            'email'    => Input::get('email'),
            'password' => Input::get('password'),
        );

        $response = array(
            'result' => 'false',
            'msg' => 'Someone already has that email. Try another?',
        );

        $model = User::whereRaw('email = ?', array($input['email']))->first();

        if ($model == null) {
            $user = new User;
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = Hash::make($input['password']);

            if ($user->save()) {
                $response = array(
                    'result' => 'true',
                    'msg' => 'Add new user successfully!',
                );
            } else {
                $response = array(
                    'result' => 'false',
                    'msg' => 'Some wrongs. Please try again or contact administrator!',
                );
            }
        }

        return Response::json($response);
    }

    ///
    public function postGetUserById() {
        $model = User::find(Input::get('id'));

        $response = array(
            'result' => 'true',
            'obj' => $model,
            'msg' => 'Get a user successfully!',
        );

        return Response::json($response);
    }

    ///
    public function postSaveEditUserById() {
        $userId = Session::get('user_id');

        if ($userId == null) {
            return Redirect::to('admin/login');
        }

        $input = array(
            'id'    => Input::get('id'),
            'name'    => Input::get('name'),
            'email'    => Input::get('email'),
            'password' => Input::get('password'),
        );

        $user = User::find($input['id']);
        $user->name = $input['name'];

        if ($input['password'] != '') {
            $user->password = Hash::make($input['password']);
        }

        if ($user->save()) {
            $response = array(
                'result' => 'true',
                'msg' => 'Edited user <b>' . $user->name . '</b> successfully!',
            );
        } else {
            $response = array(
                'result' => 'false',
                'msg' => 'Some wrongs. Please try again or contact administrator!',
            );
        }

        return Response::json($response);
    }

    ///
    public function postDeleteUserById() {
        $userId = Session::get('user_id');

        if ($userId == null) {
            return Redirect::to('admin/login');
        }

        $input = array(
            'id'    => Input::get('id'),
        );

        $user = User::find($input['id']);

        if ($user->delete()) {
            $response = array(
                'result' => 'true',
                'msg' => 'Deleted user <b>' . $user->name . '</b> successfully!',
            );
        } else {
            $response = array(
                'result' => 'false',
                'msg' => 'Some wrongs. Please try again or contact administrator!',
            );
        }

        return Response::json($response);
    }
}