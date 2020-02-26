#### 課後綜合練習(三)
##### 說明
+ 本練習承接上一回的課後綜合練習
+ 本練習只記錄要點，細節部份請自行參閱上課內容
+ 程式範例放置網址 : https://github.com/antallen/PHPproject.git
+ 其餘設定，請參閱上一回的課後綜合練習

##### 進階實作 CRUD(2)
+ 增加新的資料表
  + 表格 cars
    |欄位名稱|資料類型|參數設定|說明|
    |:---:|:---:|:---:|:---|
    |Carno|varchar(10)|PRI|車牌號碼|
    |Cusid|varchar(20)|INDEX|客戶編號|
    |CarStyleid|varchar(50)|INDEX|汽車款式編號|
  + 使用開發環境
  + 利用 artisan 針對 cars 表格，進行 migration 初始化
    ```bash
    $ php artisan make:migration create_cars_table
    ```
  + 編寫 PHPproject/database/migratins/(一堆時間)_create_cars_table.php 內容
    ```php
    <?php
    //前面略過
    public function up() {
        Schema::create('cars', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->char('Carno',10)->primary();
            $table->char('Cusid',20)->index();
            $table->char('CarStyleid',50)->index();
            $table->timestamps();
        });
    }
    //後面也略過
    ```
  + 寫好存檔後，送上 github !

+ 在正式環境操作 Migration
  + 登入正式環境
  + 切換至 PHPproject 目錄
    ```bash
    # cd /usr/share/nginx/html/PHPproject
    ```
  + 取回 PHPproject 異動的檔案
    ```bash
    # git pull origin master
    ```
  + 使用 Migration 建立資料表
    ```bash
    # php artisan migrate
    # php artisan migrate:status
    ```
  + 查看資料庫內是否建好資料表
    ```bash
    # mysql -u peter -p
    mysql> show databases;
    mysql> use cars;
    mysql> show tables;
    mysql> show columns from cars;
    mysql> exit
    ```
  
+ 使用 Eloguent 操作資料表內容
  + 使用開發環境
  + 建立 Eloguent 關連 cars 資料表
    ```bash
    $ php artisan make:model Car
    ```
  + 編寫 app/Car.php 檔案
    ```php
    <?php
    namespace App;
    use Illuminate\Database\Eloquent\Model;
    use App\Customer;

    class Car extends Model {
      //定義相關連結表格
      protected $table = 'cars';
      protected $primarykey = 'Carno';
      public $timestamps = true;

      //取得該輛車的車主ＩＤ
      public function customer(){  
        return $this->belongsTo(Customer::class,'Cusid');
      }
    }
    ```
  + 修改 app/Customer.php 檔案
    ```php
    //略過前面的程式
    //增加下列一行程式
    use App\Car;
    class Customer extends Model {
      //中間程式略過
      //取得客戶的車牌資料
      public function cars(){
          return $this->hasMany(Car::Class,'Cusid');
      }
    }
    ```
  
+ 建立控制器連接 Eloquent
  + 使用開發環境
  + 利用 artisan 建立 CarController
    ```bash
    $ php artisan make:controller CarController
    ```
  + 編修 app/Http/Controllers/CarController.php
    ```php
    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Route;
    use View;
    use App\Customer;
    use App\Car;

    class CarController extends Controller
    {
        //顯示車主所擁有的車輛
        public function index(Request $request) {
         if ($request->has('Cusid')){
            $customer = Customer::where('Cusid',$request->Cusid)->get();
            $cars = Car::where('Cusid',$request->Cusid)->get();
            return View::make('car',['customer'=>$customer,'cars'=>$cars]);
          } else {
            $customers = Customer::all();
            return View::make('board',['customers' => $customers]); 
          }
        }
    }
    ```

+ 修改路由
  + 使用開發環境
  + 編修 routes/web.php 檔案
    ```php
    //新增下列程式
    Route::get('car','CarController@index');
    ```

+ 建立 View 與 Blade 樣板
  + 使用開發環境
  + 修改 resources/views/board.blade.php
    ```php
    //將下列頃目加到「編輯」之前
    <a href="{{ action('CarController@index',['Cusid'=>$customer->Cusid]) }}" class="btn btn-success btn-sm">車輛</a>
    ```
  + 新增 resources/views/car.blade.php
    ```php
    @extends('layouts.master')
    @section('title','客戶車輛列表')
    @section('content')
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">客戶: {{ $customer[0]->Name }} 車輛清單</div>
          <div class="card-body p-1">
            <table class="table table-hover m-0">
              <thead class="thead-darty">
                <tr>
                  <th>車牌號碼</th>
                  <th>車輛款示</th>
                  <th>資料處理</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($cars as $car){
                ?>
                  <tr>
                        <td><?php echo $car->Carno; ?></td>
                        <td><?php echo $car->CarStyleid; ?></td>
                    <td></td>
                  </tr>
                  <?php }  ?>
              </tbody>
            </table>
          </div>  
        </div>
      </div>
    </div>
    @stop
    ```

+ 上傳資料至 github
+ 到正式環境，取回更新的檔案