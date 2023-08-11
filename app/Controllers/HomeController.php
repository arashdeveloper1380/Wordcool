<?php
namespace App\Controllers;

use App\Models\Sample;
use Corcel\Model\Post;
use Core\JsonQueryBuilder\JsonQueryBuilder;
use Core\Redirect\Redirect;
use Core\Request\Request;
use Core\Session\Session;
use Core\User\WCL_User;
use Core\ValidateSession\ValidateSession;
use Core\View\View;
use Illuminate\Database\Capsule\Manager as DB;

class HomeController extends Controller{

    public function index(){
        $samples = Sample::query()->orderByDesc('id','desc')->get();
        return view('index', compact('samples'));
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
            flash()->addSuccess('Your payment was processed successfully.');
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

    public function jsonHanlde(){
        $jsonHandle = new JsonQueryBuilder('app/Controllers/users.json');

        $result = $jsonHandle->select(['name', 'age'])
            ->from('books')
            ->get();

            $count = $jsonHandle->count();

            $result = $jsonHandle->select(['id', 'name', 'age'])
                      ->from('users')
                      ->orderBy('id','desc')
                      ->where('age', '>', '30')
                      ->get();

            // $find = $jsonHandle->find('name','arash')->get();
            $first = $jsonHandle->where('name', '=', 'arash')->first();
            dd($first);

    }

    public function delete($id){

        $sample = Sample::query()->find($id);
        $sample->delete();

        $session = Session::getInstance();
        $session->set('success', 'User has Deleted');
        redirectBack();
    }
}