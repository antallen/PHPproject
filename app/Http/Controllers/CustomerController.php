<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use View;
use App\Customer;

class CustomerController extends Controller
{
    //客戶列表
    public function index() {
        $customers = Customer::all();
        return View::make('board',['customers' => $customers]);
    }

    //新增客戶資料
    public function new(){
        return "Hello";
    }
}
