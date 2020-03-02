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

#####  Auth 鷹架應用實作 : 修改登入方式
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

##### 參考範例
+ [更新 nodejs 以及 npm](https://www.codepeople.cn/2019/10/09/CentOS7.4-install-nodejs/)
+ [建立 Auth 鷹架](https://officeguide.cc/laravel-6-create-project-with-user-authentication/)
+ [修改 Auth 鷹架](https://officeguide.cc/laravel-6-how-to-let-user-login-with-email-or-username/)