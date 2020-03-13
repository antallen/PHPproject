<?php
namespace App\Services;

use App\Repositories\CarRepository;
use App\Repositories\CustomerRepository;

class CarCustomerService
{
    protected $customers;
    protected $cars;
    /*
    *    creae install for Model
    */
    public function __construct(CarRepository $cars, CustomerRepository $customers)
    {
        $this->customers = $customers;
        $this->cars = $cars;
    }

    //取得特定車主與車輛資料
    public function getCars($Cusid){
        return [
            'customer' => $this->customer->getOneCustomer($cusid),
            'cars' => $this->cars->getAllCar($cusid)
        ];
    }
}