#### 課後綜合練習(二)
##### 說明
+ 本練習承接上一回的課後綜合練習
+ 本練習只記錄要點，細節部份請自行參閱上課內容
+ 程式範例放置網址 : https://github.com/antallen/PHPproject.git
+ 其餘設定，請參閱上一回的課後綜合練習

##### 進階實作 CRUD 
+ 建立新增客戶用的表格
  + 修改 routes/web.php
    ```php
    //修改成以下項目
    //Route::resource('customer', 'CustomerController');
    Route::get('customer', 'CustomerController@index');
    Route::get('new', 'CustomerController@new');
    Route::post('store','CustomerController@store');
    ```
  + 修改 resources/views/partials/nav.blade.php
    ```php
    <nav class="navbar navbar-expand-lg navbar-light navbar-default">
      <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
          專案站台
        </a>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item active">  
              <a href="{{ action('CustomerController@index') }}" class="nav-link">
              客戶列表
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ action('CustomerController@new') }}" class="nav-link">
              新增客戶
              </a>
          </li>
        </ul>
      </div>
    </nav>
    ```
  + 修改 app/Http/Controllers/CustomerController.php
    ```php
    (略過部份程式)
    //新增客戶資料
    public function new() {
      return View::make('new');
    }
    //將新客戶資料寫入資料庫的程式
    //先寫個測試行，看是否真的有收到新增的資料
    public function store(Request $request){
        $customers = $request->only('Cusid','Name','Address','Phone');
        dd($customers);
    }
    (略過部份程式)
    ```
  + 新增 resources/views/new.blade.php
    ```php
    @extends('layouts.master')
    @section('title','新增客戶')
    @section('content')
    <form action="{{ action('CustomerController@store') }}" method="post">
        @csrf
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">新增客戶</div>
            <div class="card-body p-1">
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Cusid" class="col-sm-2 col-form-label">客戶編號</label>
                    <div class="col-sm-8">
                        <input type="text"class="form-control" id="Cusid" name="Cusid" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Name" class="col-sm-2 col-form-label">客戶姓名</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="Name" name="Name" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Address" class="col-sm-2 col-form-label">通訊地址</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="Address" name="Address" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Phone" class="col-sm-2 col-form-label">連絡電話</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="Phone" name="Phone" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-9">
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
  + 將修改好的檔案，送上 github
  + 在正式環境下拉專案，並查看是否可以看見表格！

+ 將資料送進 customers 資料表
  + 修改 app/Http/Controllers/CustomerController.php
    ```php
    //前面的程式略過
    //修改原來的程式，將新客戶資料寫入資料庫
    public function store(Request $request){
        if ($request->cancel){
            $customers = Customer::all();
            return View::make('board',['customers' => $customers]);
        }
        $customers = new Customer;
        $customers->Cusid=$request->input('Cusid');
        $customers->Name=$request->input('Name');
        $customers->Address=$request->input('Address');
        $customers->Phone=$request->input('Phone');
        $customers->save();
        return redirect('customer');
    }
    ```
  + 將修改好的檔案，送上 github
  + 在正式環境下拉專案，並查看是否可以看見新增後的資料！

+ 增加可修訂客戶資料的項目
  + 修改 resources/views/board.blade.php
    ```php
    //前後程式碼略過
    <table class="table table-hover m-0">
        <thead class="thead-darty">
            <tr>
            <th>客戶編號</th>
            <th>客戶姓名</th>
            <th>客戶電話</th>
            <td>資料處理</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($customers as $customer){
            ?>
            <tr>
                <td><?php echo $customer->Cusid; ?></td>
                <td><?php echo $customer->Name; ?></td>
                <td><?php echo $customer->Phone; ?></td>
                <td><a href="{{ action('CustomerController@edit', ['Cusid'=>$customer->Cusid]) }}" class="btn btn-success btn-sm">編輯</a></td>
            </tr>
            <?php }  ?>
    </tbody>
    </table>
    ```
  + 修改 routes/web.php
    ```php
    //增加下列兩行
    Route::get('edit','CustomerController@edit');
    Route::post('update','CustomerController@update');
    ```
  + 修改  app/Http/Controllers/CustomerController.php
    ```php
    //增加下列程式
    //修改客戶資料表格
    public function edit(Request $request){
        return View::make('edit',['Cusid'=>$request->Cusid,'Name'=>$request->Name,'Address'=>$request->Address,'Phone'=>$request->Phone]);
    }
    //更新客戶資料
    public function update(Request $request){
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
        return View::make('board',['customers' => $customers]); 
    }
    ```
  + 新增 resources/views/edit.blade.php
    ```php
    @extends('layouts.master')
    @section('title','編輯客戶資料')
    @section('content')
    <form action="{{ action('CustomerController@update') }}" method="post">
        @csrf
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">編輯客戶資料</div>
            <div class="card-body p-1">
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Cusid" class="col-sm-2 col-form-label">客戶編號</label>
                    <div class="col-sm-8">
                        <input type="text"class="form-control" id="Cusid" name="Cusid" value="<?php echo $_GET['Cusid']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Name" class="col-sm-2 col-form-label">客戶姓名</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $_GET['Name']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Address" class="col-sm-2 col-form-label">通訊地址</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="Address" name="Address" value="<?php echo $_GET['Address']; ?>">  
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <label for="Phone" class="col-sm-2 col-form-label">連絡電話</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="Phone" name="Phone" value="<?php echo $_GET['Phone']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-9">
                        <input type="submit" class="btn btn-primary" value="送出">
                        <input type="hidden" id="oldId" name="oldId"  value="<?php echo $_GET['Cusid']; ?>">
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
  + 將修改好的檔案，送上 github
  + 在正式環境下拉專案，並查看是否可以看見修訂後的資料！

+ 增加刪除客戶資料的項目
  + 修改 resources/views/board.blade.php
    ```php
    <!-- 前面略過 -->
    <td><a href="{{ action('CustomerController@edit', ['Cusid'=>$customer->Cusid]) }}" class="btn btn-success btn-sm">編輯</a>
    <a href="{{ action('CustomerController@delete', ['Cusid'=>$customer->Cusid]) }}" class="btn btn-danger btn-sm">刪除</a></td>
    <!-- 後面也略過 -->
    ```
  + 修改 routes/web.conf
    ```php
    //增加下列哪一行
    Route::get('delete','CustomerController@delete');
    ```
  + 修改 app/Http/Controllers/CustomerController.php
    ```php
    //增加下列 function
    //刪除客戶資料
    public function delete(Request $request){
        Customer::where('Cusid',$request->input('Cusid'))->delete();
        $customers = Customer::all();
        return View::make('board',['customers' => $customers]); 
    }
    ```
  + 將修改好的檔案，送上 github
  + 在正式環境下拉專案，並查看是否可以看見刪除後的資料！