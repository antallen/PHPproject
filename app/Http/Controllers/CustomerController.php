<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCustomer;
use Illuminate\Http\Request;
use Route;
use View;
use App\Customer;
use App\Repositories\CustomerRepository;
use App\Services\CarCustomerService;

class CustomerController extends Controller
{
    protected $CarCustomerService;
    public function __construct(CarCustomerService $CarCustomerService){
        $this->CarCustomerService = $CarCustomerService;
    }

    //客戶列表
    public function index() {
        $list = $this->CarCustomerService->getCustomers();
        return View::make('board',['customers' => $list]);
    }

    //新增客戶資料
    public function new() {
        return View::make('new');
    }

    //將新客戶資料寫入資料庫
    public function store(Request $request){
        if (!($request->cancel)){
            $this->CarCustomerService->newCustomers($request);
        }
        return redirect('customer');
    }

    //修改客戶資料表格
    public function edit(Request $request){
        //$customers=$request->Cusid;
        //dd($customers);
        return View::make('edit',['Cusid'=>$request->Cusid,'Name'=>$request->Name,'Address'=>$request->Address,'Phone'=>$request->Phone]);
    }

    //更新客戶資料
    public function update(EditCustomer $request){
        if ($request->cancel){
            $customers = Customer::all();
            return View::make('board',['customers' => $customers]);
        } 
        $customers = Customer::where('Cusid',$request->input('oldId'))
                                    ->update(['Cusid'=> $request->input('Cusid'),
                                    'Name'=> $request->input('Name'),
                                    'Address'=> $request->input('Address'),
                                    'Phone'=> $request->input('Phone')
        ]);
        $customers = Customer::all();
        return View::make('board',['customers' => $customers,'msg' => '修改成功']); 
    }

    //刪除客戶資料
    public function delete(Request $request){
        Customer::where('Cusid',$request->input('Cusid'))->delete();
        $customers = Customer::all();
        return View::make('board',['customers' => $customers]); 
    }
}
