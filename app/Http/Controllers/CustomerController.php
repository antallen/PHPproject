<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use View;
use App\Customer;

class CustomerController extends Controller
{
    //
    public function index() {
        $customers = Customer::all();
        return View::make('board',['customers' => $customers]);
    }
}
