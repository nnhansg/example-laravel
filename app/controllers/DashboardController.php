<?php

class DashboardController extends BaseController {
    public function getDashboardAdmin() {
        $userId = Session::get('user_id');

        if ($userId == null) {
            return Redirect::to('admin/login');
        }

        $model = User::find($userId);

        return View::make('admin/dashboard');
    }

    public function postDashboardAdmin() {
        //Session::forget('user.id');
        //return Redirect::intended('admin/login');
    }
}
