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
            Redirect::back();
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

    // public function store(){
    //     $request = new Request();
    //     $name = $request->get('name');
    //     $id = $request->get('id');
    //     echo $name . ' ' . $id;
    // }
}