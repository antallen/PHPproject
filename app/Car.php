<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //定義相關連結表格
    protected $table = 'cars';
    protected $primarykey = 'Carno';
    public $timestamps = true;

    //取得該輛車的車主ＩＤ
    public function customers(){  
        return $this->belongsTo(CustomerEloquent::class,'Cusid');
    }
}
