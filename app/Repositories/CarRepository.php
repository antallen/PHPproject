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
    public function getAllCar(Request $request){
        return $this->car->where('Cusid',$request->Cusid)->get();
    }
}