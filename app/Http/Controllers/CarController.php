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
            return View::make('car',['customer'=>$customer,'cars'=>$cars]);
            
        } else {
            $customers = Customer::all();
            return View::make('board',['customers'=>$customers]); 
        }
        
    }
    
    //新增車輛的表格
    public function new(Request $request){
        return View::make('carnew',['Cusid'=>$request->Cusid]);
    }
    //儲存客戶車輛資料
    public function store(Request $request){
        $car=$request->only('Cusid','Carno','CarStyleid');
        dd($car);
    }
}
