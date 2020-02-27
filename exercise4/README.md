#### 課後綜合練習(四)
##### 說明
+ 本練習承接上一回的課後綜合練習
+ 本練習只記錄要點，細節部份請自行參閱上課內容
+ 程式範例放置網址 : https://github.com/antallen/PHPproject.git
+ 其餘設定，請參閱上一回的課後綜合練習

##### 進階實作 CRUD(3)
+ 新增資料進入資料表
  + 修改 resources/views/car.blade.php
    ```php
    <!-- 前面略過 -->
    <div class="card-header">客戶: {{ $customer[0]->Name }} 車輛清單
            <a href="{{ action('CarController@new',['Cusid'=>$customer[0]->Cusid]) }}" class="col-md-10 text-right">新增車輛</a>
        </div>
    <!-- 後面也略過 -->
    ```
  + 修改 routes/web.php
    ```php
    //新增下列二行
    Route::get('carnew','CarController@new');
    Route::post('carstore','CarController@store');
    ```
  + 修改 app/Http/Controllers/CarController.php
    ```php
    //前面的程式碼略過
    //新增車輛的表格
    public function new(Request $request){
        return View::make('carnew',['Cusid'=>$request->Cusid]);
    }
    //儲存客戶車輛資料
    public function store(Request $request){
        if ($request->cancel){
            $customer = Customer::where('Cusid',$request->Cusid)->get();
            $cars = Car::where('Cusid',$request->Cusid)->get();
            return View::make('car',['customer'=>$customer,'cars'=>$cars]);
        }
        $car = new Car;
        $car->Carno=$request->input('Carno');
        $car->Cusid=$request->input('Cusid');
        $car->CarStyleid=$request->input('CarStyleid');
        $car->save();
        $customer = Customer::where('Cusid',$request->Cusid)->get();
        $cars = Car::where('Cusid',$request->Cusid)->get();
        return View::make('car',['customer'=>$customer,'cars'=>$cars]);
    }
    ```
  + 新增 resources/views/carnew.blade.php
    ```php
    @extends('layouts.master')
    @section('title','新增客戶車輛')
    @section('content')
    <form action="{{ action('CarController@store') }}" method="post">
        @csrf
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">新增客戶車輛</div>
            <div class="card-body p-1">
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Cusid" class="col-sm-2 col-form-label">客戶編號</label>
                    <div class="col-sm-8">
                        {{ $Cusid }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Carno" class="col-sm-2 col-form-label">車牌號碼</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="Carno" name="Carno" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="CarStyleid" class="col-sm-2 col-form-label">車輛款示</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="CarStyleid" name="CarStyleid" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-9">
                        <input type="hidden" id="Cusid" name="Cusid" value="{{ $Cusid }}">
                        <input type="submit" class="btn btn-primary" value="送出">
                    </div>
                    <div class="col-sm-1">
                        <input type="submit" class="btn btn-warning" value="取消" name="cancel">
                    </div>
                </div>  
            </div>
            </div>
        </div>
        </div>
    </form>
    @stop
    ```
  + 存檔後，送上 github
  + 到正式環境，取回更新的檔案

+ 新增修改/刪除車輛資料功能
  + 修改 resources/views/car.blade.php
    ```php
    <!-- 前面略過 -->
    <tbody>
    <?php
        foreach ($cars as $car){
    ?>
        <tr>
            <td>{{ $car->Carno }}</td>
            <td>{{ $car->CarStyleid }}</td>
        <td><a href="{{ action('CarController@edit', 
                        ['Cusid'=>$customer[0]->Cusid,
                        'Carno'=>$car->Carno,
                        'CarStyleid'=>$car->CarStyleid]) }}" class="btn btn-success btn-sm">編輯</a>
        <a href="{{ action('CarController@delete', ['Carno'=>$car->Carno,'Cusid'=>$customer[0]->Cusid]) }}" class="btn btn-danger btn-sm">刪除</a></td>
        </tr>
        <?php }  ?>
    </tbody>
    <!-- 後面也略過 -->
    ```
  + 修改 routes/web.php
    ```php
    //增加下列三行程式碼
    Route::get('caredit','CarController@edit');
    Route::post('carupdate','CarController@update');
    Route::get('cardelete','CarController@delete');
    ```
  + 修改 app/Http/Controllers/CarController.php
    ```php
    //前面的程式碼略過
    //編輯客戶車輛程式
    public function edit(Request $request){
        return View::make('caredit',['Cusid'=>$request->Cusid,'Carno'=>$request->Carno,'CarStyleid'=>$request->CarStyleid]);
    }
    //更新客戶車輛資料
    public function update(Request $request){
        if ($request->cancel){
            $customer = Customer::where('Cusid',$request->Cusid)->get();
            $cars = Car::where('Cusid',$request->Cusid)->get();
            return View::make('car',['customer'=>$customer,'cars'=>$cars]);
        }
        $car = Car::where('Carno',$request->input('oldCarno'))
                          ->update(['Carno'=>$request->input('Carno'),
                          'CarStyleid'=>$request->input('CarStyleid')]);
        $customer = Customer::where('Cusid',$request->Cusid)->get();
        $cars = Car::where('Cusid',$request->Cusid)->get();
        return View::make('car',['customer'=>$customer,'cars'=>$cars]);
    }
    
    //刪除客戶車輛資料
    public function delete(Request $request){
    Car::where('Carno',$request->input('Carno'))->delete();
    $customer = Customer::where('Cusid',$request->Cusid)->get();
    $cars = Car::where('Cusid',$request->Cusid)->get();
    return View::make('car',['customer'=>$customer,'cars'=>$cars]);
    }
    ```

  + 新增 resources/views/caredit.blade.php
    ```php
    @extends('layouts.master')
    @section('title','編輯客戶車輛資料')
    @section('content')
    <form action="{{ action('CarController@update') }}" method="post">
        @csrf
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">編修客戶車輛資料</div>
            <div class="card-body p-1">
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Cusid" class="col-sm-2 col-form-label">客戶編號</label>
                    <div class="col-sm-8">{{ $Cusid }}</div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Carno" class="col-sm-2 col-form-label">車牌號碼</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="Carno" name="Carno" value="{{ $Carno }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="CarStyleid" class="col-sm-2 col-form-label">車輛款示</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="CarStyleid" name="CarStyleid" value="{{ $CarStyleid }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-9">
                        <input type="hidden" id="Cusid" name="Cusid" value="{{ $Cusid }}">
                        <input type="hidden" id="oldCarno" name="oldCarno" value="{{ $Cusno }}">
                        <input type="submit" class="btn btn-primary" value="送出">
                    </div>
                    <div class="col-sm-1">
                        <input type="submit" class="btn btn-warning" value="取消" name="cancel">
                    </div>
                </div>  
            </div>
            </div>
        </div>
        </div>
    </form>
    @stop
    ```
  + 存檔後，送上 github
  + 到正式環境，取回更新的檔案
