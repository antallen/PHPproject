<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Car;
class CarRepository
{
    protected $cars;
    /*
    *    creae install for Model
    */
    public function __construct(Car $cars){
        $this->cars = $cars;
    }
    //取得該車主所有車輛資料的方法
    public function getAllCar($cusid){
        return $this->cars->where('Cusid',$cusid)->get();
    }
    //建立車輛資料
    public function createCar(Request $carData){
        //dd($carData->Carno,$carData->Cusid);
        $car = new Car;
        $car->Carno=$carData->Carno;
        $car->Cusid=$carData->Cusid;
        $car->CarStyleid=$carData->CarStyleid;
        $car->save();
        return $carData->Cusid;
    }
}