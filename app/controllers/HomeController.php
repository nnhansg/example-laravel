<?php

class HomeController extends BaseController {
    public function showHome() {
        return View::make('sites/home');
    }
}
