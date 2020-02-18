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
    public function new() {
        //$customers = Customer::all();
        //return View::make('new',['customers' => $customers]);
        return View::make('new');
    }

    //將新客戶資料寫入資料庫
    public function store(Request $request){
        $customers = new Customer;
        $customers->Cusid=$request->input('Cusid');
        $customers->Name=$request->input('Name');
        $customers->Address=$request->input('Address');
        $customers->Phone=$request->input('Phone');
        $customers->save();
        return redirect('customer');
    }

    //修改客戶資料表格
    public function edit(Request $request){
        //$customers=$request->Cusid;
        //dd($customers);
        return View::make('edit',['Cusid'=>$request->Cusid,'Name'=>$request->Name,'Address'=>$request->Address,'Phone'=>$request->Phone]);
    }
}
