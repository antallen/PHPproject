<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // 對應資料表 customers
    protected $table = 'customers';
    protected $primarykey = 'Cusid';
    public $timestamps = true;

    //取得客戶的車牌資料
    public function cars(){
        return $this->hasMany(CarEloquent::Class,'Cusid');
    }
}
