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
            $customer = Customer::where('Cusid',$request->Cusid);
            $cars = Car::where('Cusid',$request->Cusid);
            //return View::make('car',['customer' => $customer,'cars' => $cars]);
            dd($customer->Name);
        } else {
            $customers = Customer::all();
            return View::make('board',['customers' => $customers]); 
        }
        
      }
}
