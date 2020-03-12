<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use View;
use App\Customer;
use App\Car;
use App\Repositories\CarRepository;

class CarController extends Controller
{
    protected $cars;
    protected $customers;
    public function __construct(CarRepository $cars){
        $this->cars = $cars;
    }
    //顯示車主所擁有的車輛
    public function index(Request $request) {
        if ($request->has('Cusid')){
            $customer = Customer::where('Cusid',$request->Cusid)->get();
            /*
            $cars = Car::where('Cusid',$request->Cusid)->get();
            return View::make('car',['customer'=>$customer,'cars'=>$cars]);
            */
            $list = $this->cars->getAllCar($request->Cusid);
            return View::make('car',['customer'=>$customer,'cars'=>$list]);
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
        if ($request->cancel){
            $customer = Customer::where('Cusid',$request->Cusid)->get();
            $cars = Car::where('Cusid',$request->Cusid)->get();
            return View::make('car',['customer'=>$customer,'cars'=>$cars]);
        }
        $car = new Car;
        $car->Carno=$request->input('Carno');
        $car->Cusid=$request->input('Cusid');
        $car->CarStyleid=$request->input('CarStyleid');
        $car->save();
        $customer = Customer::where('Cusid',$request->Cusid)->get();
        $cars = Car::where('Cusid',$request->Cusid)->get();
        return View::make('car',['customer'=>$customer,'cars'=>$cars]);
    }
    //編輯客戶車輛程式
    public function edit(Request $request){
        return View::make('caredit',['Cusid'=>$request->Cusid,'Carno'=>$request->Carno,'CarStyleid'=>$request->CarStyleid]);
    }
    //更新客戶車輛資料
    public function update(Request $request){
        if ($request->cancel){
            $customer = Customer::where('Cusid',$request->Cusid)->get();
            $cars = Car::where('Cusid',$request->Cusid)->get();
            return View::make('car',['customer'=>$customer,'cars'=>$cars]);
        }
        $car = Car::where('Carno',$request->input('oldCarno'))
                          ->update(['Carno'=>$request->input('Carno'),
                          'CarStyleid'=>$request->input('CarStyleid')]);
        $customer = Customer::where('Cusid',$request->Cusid)->get();
        $cars = Car::where('Cusid',$request->Cusid)->get();
        return View::make('car',['customer'=>$customer,'cars'=>$cars]);
    }
    //刪除客戶車輛資料
    public function delete(Request $request){
        Car::where('Carno',$request->input('Carno'))->delete();
        $customer = Customer::where('Cusid',$request->Cusid)->get();
        $cars = Car::where('Cusid',$request->Cusid)->get();
        return View::make('car',['customer'=>$customer,'cars'=>$cars]);
    }
}
