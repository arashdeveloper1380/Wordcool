<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Sample;
use Core\Request;
use Core\View;

class MenuPageController extends Controller
{

    public function index(){
        $name = "کاربران";
        $sample = Sample::query()->orderByDesc('id')->get();
        View::renderBlade('test', compact('name','sample'));
    }

    public function destroy()
    {
        $request = new Request();
        dd($request->all());
    }
}