<?php
namespace Admin\Controller;

class IndexController extends BaseController {
    // 首页
    public function index () {
        if (!cookie('username')) {
            $this -> redirect('login');
        } else {
            $this -> display();
        }
    }

    // 登录页
    public function login () {
        if (cookie('username')) {
            $this -> redirect('index');
        } else {
            $this -> display();
        }
    }
}