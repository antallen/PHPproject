<?php
namespace App\Repositories;

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
}