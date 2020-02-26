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
            $cusid = $request->Cusid;
            $cars = Car::where('Cusid',$request->input('Cusid'));
            return View::make('car',['Cusid' => $cusid,'cars' => $cars]);
        } else {
            $customers = Customer::all();
            return View::make('board',['customers' => $customers]); 
        }
        
      }
}
