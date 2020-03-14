<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Customer;

class CustomerRepository{

    protected $customers;
    /*
    *    creae install for Model
    */
    public function __construct(Customer $customers){
        $this->customers = $customers;
    }
    // 取得 customers 資料的方法
    public function getAllCustomer(){
        return $this->customers->all();
    }
    // 取得特定客戶資料的方法
    public function getOneCustomer($cusid){
        return $this->customers
                    ->where('Cusid','=',$cusid)
                    ->get();
    }

    // 新增客戶資料的方法
    public function newCustomer(Request $customerData){
        $customers = new Customer;
        $customers->Cusid=$customerData->Cusid;
        $customers->Name=$customerData->Name;
        $customers->Address=$customerData->Address;
        $customers->Phone=$customerData->Phone;
        $customers->save();
        return $customerData->Cusid;
    }

    // 更新客戶資料的方法
    public function updateCustomer($customerData){
        $customers = Customer::where('Cusid',$customerData->oldId)
                                    ->update(['Cusid'=> $customerData->Cusid,
                                    'Name'=> $customerData->Name,
                                    'Address'=> $customerData->Address,
                                    'Phone'=> $customerData->Phone]);
        return $customerData->Cusid;
    }
}