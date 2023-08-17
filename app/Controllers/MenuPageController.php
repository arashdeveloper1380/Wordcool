<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Sample;
use Core\Request\Request;

class MenuPageController extends Controller
{

    public function index(){
        $name = "کاربران";
        $sample = Sample::query()->orderByDesc('id')->get();
        return view('test', compact('name', 'sample'));
    }

    public function destroy(){
        $request = new Request();
        dd($request->all());
    }
}