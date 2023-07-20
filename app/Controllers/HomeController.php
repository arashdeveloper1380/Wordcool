<?php
namespace Controllers;

include ARASH_DIR . 'init.php';
include ARASH_DIR . 'app/Models/Sample.php';
use Sample;
use Controller;
use Redirect;
use Request;
use View;
use ValidateSession;
use Session;
use AR_User;


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
        AR_User::createUser('ali','ali@gmail.com','123');
        redirectUrl(route('/'));
    }

    public function insertUser(){
        $insertUser = AR_User::insertUser([
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
        $update_user = AR_User::updateUser($id, [
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
        $delete_user = AR_User::deleteUser($id);
        if($delete_user){
            $session = Session::getInstance();
            $session->set('success', 'User deleted successful');
            redirectUrl(route('/'));
        }
    }
}