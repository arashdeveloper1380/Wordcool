<?php
namespace app\Controllers;

include ARASH_DIR . 'init.php';
include ARASH_DIR . 'app/Models/Sample.php';

use app\Models\Sample;
use app\Controllers\Controller;
use core\Redirect;
use core\Request;
use core\View;
use core\ValidateSession;
use core\Session;
use WCL_User;


class HomeController extends Controller{

    public function index(){
        $samples = Sample::query()->orderByDesc('id','desc')->get();
        View::render('front.index',compact('samples'));
        
    }

    public function save(){
        $session = Session::getInstance();
        $request = new Request();

        $validate = [
            'name'  => 'required|max:50|min:2|string',
            'phone' => 'required|max:11'
        ];

        $errors = $request->validate($validate);

        if(!empty($errors)){
            $errors = ValidateSession::setErrors($errors);
            Redirect::back(); // or redirectBack()
        } else {
            $name = $request->post('name');
            $phone = $request->post('phone');

            Sample::create([
                'name'  => $name,
                'phone' => $phone
            ]);

            $session->set('success', 'created successful');
            redirectBack(); // or Redirect::back()
            
        }
    }

    public function createUser(){
        WCL_User::createUser('ali','ali@gmail.com','123');
        redirectUrl(route('/'));
    }

    public function insertUser(){
        $insertUser = WCL_User::insertUser([
            'user_login' => 'arash',
            'user_email' => 'arash@example.com',
            'user_pass'  => '123456789',
            'first_name' => 'آرش',
            'last_name'  => 'نریمانی',
        ]);

        if($insertUser){
            $session = Session::getInstance();
            $session->set('success', 'User inserted successful');
            redirectUrl(route('/'));
        }
    }

    public function updateUser($id){
        $update_user = WCL_User::updateUser($id, [
            'user_login' => 'mehdi',
            'user_email' => 'mehdi@example.com',
            'user_pass'  => '123456789',
            'first_name' => 'مهدی',
            'last_name'  => 'قیاسی',
        ]);

        if($update_user){
            $session = Session::getInstance();
            $session->set('success', 'User updated successful');
            redirectUrl(route('/'));
        }
    }

    public function deleteUser($id){
        $delete_user = WCL_User::deleteUser($id);
        if($delete_user){
            $session = Session::getInstance();
            $session->set('success', 'User deleted successful');
            redirectUrl(route('/'));
        }
    }

    public function metaUser(){
        // AR_User::updateUserMeta(1, 'job', 'developer');
        // Redirect::url(route('/'));
        // $job = WCL_User::getUserMeta(1, 'job');
        // echo $job;
        if(WCL_User::isUserLoggedIn()){
            echo "login";
        }else{
            echo "not login";
        }
    }

    public function costomLogin(){
        WCL_User::customLoginForm([
            'echo'           => true,
            'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
            'form_id'        => 'login-form',
            'label_username' => __( 'نام کاربری' ),
            'label_password' => __( 'رمز عبور' ),
            'label_remember' => __( 'مرا به خاطر بسپار' ),
            'label_log_in'   => __( 'ورود' ),
            'id_username'    => 'user_login',
            'id_password'    => 'user_pass',
            'id_remember'    => 'rememberme',
            'id_submit'      => 'wp-submit',
            'remember'       => true,
            'value_username' => '',
            'value_remember' => false
        ]);
    }

    public function userCount(){
        $users = WCL_User::getUserCount();
        dd($users);
    }

    public function countUserPosts(){
        $count_user_posts = WCL_User::countUserPosts(1, 'page');
        dd($count_user_posts);
    }

    public function countManyUsersPosts(){
        $user_ids = [1];
        $countManyUsersPosts = WCL_User::countManyUsersPosts($user_ids);
        dd($countManyUsersPosts);
    }

    public function getCurrentUser(){
        $currenmt_user = WCL_User::getCurrentUser();
        dd($currenmt_user);
    }

    public function getUserData($id){
        dd(WCL_User::getUserData($id));
    }
}