#### 課後綜合練習(六)
##### 說明
+ 本練習承接上一回的課後綜合練習
+ 本練習只記錄要點，細節部份請自行參閱上課內容
+ 程式範例放置網址 : https://github.com/antallen/PHPproject.git
+ 其餘設定，請參閱上一回的課後綜合練習

##### Auth 鷹架應用實作 : 基本架設
+ 使用開發環境
  + 安裝 Auth 鷹架
    ```bash
    $ composer require laravel/ui --dev
    $ php artisan ui bootstrap --auth
    $ npm install && npm run dev
    ```
  + 將資料先 git 上 github

+ 使用正式環境
  + 安裝資料庫
    ```bash
    # php artisan migrate
    ```
  + 可使用瀏覽器，進行註冊與登入

#####  Auth 鷹架應用實作 : 取消註冊功能
+ 使用開發環境
  + 修改 routes/web.php
    ```php
    //預設驗證功能
    //Auth::routes();
    //啟用 Email 驗證功能
    //Auth::routes(['verify'=>true]);
    //取消註冊功能
    Auth::routes(['register' => false]);
    Route::get('/home', 'HomeController@index')->name('home');
    ```
  + 將資料先 git 上 github
  + 在正式環境中，取得 github 上的檔案
  + 使用瀏覽器，進行註冊與登入

#####  Auth 鷹架應用實作 : 修改登入方式
+ 使用開發環境
  + 修改 database/migrations/<一堆時間>_create_users_table.php
    ```php
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('loginname');  // 增加這行，用於「登入的帳號」
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    ```
  + 修改 resources/views/auth/register.blade.php
    ```php
    <div class="form-group row">
        <!-- 增加「loginname」-->
        <label for="loginname" class="col-md-4 col-form-label text-md-right">{{ __('Login Name') }}</label>

        <div class="col-md-6">
            <input id="loginname" type="text" class="form-control @error('loginname') is-invalid @enderror" name="loginname" value="{{ old('loginname') }}" required autocomplete="loginname" autofocus>

            @error('loginname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    ```
  + 修改 app/Http/Controllers/Auth/RegisterController.php
    ```php
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'loginname' => ['required', 'string', 'max:255', 'unique:users'],  // 驗證使用者帳號名稱
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    //中間略過
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'loginname' => $data['loginname'],  // 使用者帳號名稱
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    ```
  + 修改 resources/views/auth/login.blade.php
    ```php
    <!-- 將 email 名稱，改成 loginname -->
    <div class="form-group row">
        <label for="loginname" class="col-md-4 col-form-label text-md-right">{{ __('Login Name') }}</label>

        <div class="col-md-6">
            <input id="loginname" type="text" class="form-control @error('loginname') is-invalid @enderror" name="loginname" value="{{ old('loginname') }}" required autocomplete="loginname" autofocus>

            @error('loginname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    ```
  + 修改 app/Http/Controllers/Auth/LoginController.php
    ```php
    //覆寫 AuthenticatiesUsers 中的 username() 方法
    public function username()
    {
        return 'loginname';
    }
    ```
  + 修改 app/User.php
    ```php
    //增加 loginname 項目
    protected $fillable = [
        'name', 'email', 'password','loginname',
    ];
    ```
  + 將資料先 git 上 github

+ 使用正式環境
  + 從 github 上取回程式
  + 先將 migration 更新(資料庫內的資料會全部不見)
    ```bash
    # php artisan migrate:refresh
    ```
  + 開啟瀏覽器進行測試
  
#####  Auth 鷹架應用實作 : 將網頁加入身份驗證
+ 使用開發環境
  + 修改 routes/web.conf
    ```php
    //前面略過
    Route::middleware('auth')->group(function(){
        Route::get('new','CustomerController@new');
        Route::post('store','CustomerController@store');
        Route::get('edit','CustomerController@edit');
        Route::post('update','CustomerController@update');
        Route::get('delete','CustomerController@delete');
        Route::get('carnew','CarController@new');
        Route::post('carstore','CarController@store');
        Route::get('caredit','CarController@edit');
        Route::post('carupdate','CarController@update');
        Route::get('cardelete','CarController@delete');
    });
    Route::get('customer','CustomerController@index');
    Route::get('car','CarController@index');
    //後面略過
    ```
  + 將資料先 git 上 github

+ 使用正式環境
  + 從 github 上取回程式
  + 開啟瀏覽器進行測試

##### 參考範例
+ [更新 nodejs 以及 npm](https://www.codepeople.cn/2019/10/09/CentOS7.4-install-nodejs/)
+ [建立 Auth 鷹架](https://officeguide.cc/laravel-6-create-project-with-user-authentication/)
+ [修改 Auth 鷹架](https://officeguide.cc/laravel-6-how-to-let-user-login-with-email-or-username/)