<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use View;
use App\Customer;
use App\Car;

class CarController extends Controller
{
    //顯示車主所擁有的車輛
    public function index(Request $request) {
        if ($request->has('Cusid')){
            $customer = Customer::where('Cusid',$request->Cusid)->get();
            $cars = Car::where('Cusid',$request->Cusid)->get();
            //return View::make('car',['customer'=>$customer,'cars'=>$cars]);
            dd($customer);
        } else {
            $customers = Customer::all();
            return View::make('board',['customers' => $customers]); 
        }
        
      }
}
