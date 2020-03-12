#### 課後綜合練習(七)
##### 說明
+ 本練習承接上一回的課後綜合練習
+ 本練習只記錄要點，細節部份請自行參閱上課內容
+ 程式範例放置網址 : https://github.com/antallen/PHPproject.git
+ 其餘設定，請參閱上一回的課後綜合練習

##### 使用 Repository Pattern 優化程式碼內容
+ 新增 Repository 指令
  + 在 app/Console 目錄下，建立一個 Commands 目錄
  + 在 app/Console/Commands 目錄下，建立 RepositoryMakeCommand.php
  + 編修 RepositoryMakeCommand.php
    ```php
    <?php
    namespace App\Console\Commands;
    use Illuminate\Console\GeneratorCommand;

    class RepositoryMakeCommand extends GeneratorCommand
    {
        /**
        * The console command name.
        *
        * @var string
        */
        protected $name = 'make:repository';

        /**
        * The console command description.
        *
        * @var string
        */
        protected $description = 'Create a new repository class';

        /**
        * The type of class being generated.
        *
        * @var string
        */
        protected $type = 'Repository';

        /**
        * Get the stub file for the generator.
        *
        * @return string
        */
        protected function getStub()
        {
            return __DIR__.'/stubs/repository.stub';
        }

        /**
        * Get the default namespace for the class.
        *
        * @param string $rootNamespace
        * @return string
        */
        protected function getDefaultNamespace($rootNamespace)
        {
        //設定的Repository目錄位置
            return $rootNamespace.'\Repositories';
        }
    }
    ```
    + 建立 app/Console/Commands/stubs 目錄
    + 在 app/Console/Commands/stubs 目錄下，建立模板檔案 repository.stub
      ```php
      <?php
        namespace DummyNamespace;
        class DummyClass
        {
            /*
            *    creae install for Model
            */
            public function __construct ()
            {
            }
        }
      ```
    + 編修 app/Console/Kernel.php, 註冊 RepositoryMakeCommand
      ```php
      // 修改下列部份即可
      protected $commands = [
        //建立產生 repository 的命令
        commands\RepositoryMakeCommand::Class
      ];
      ```
    + 測試實作
      ```bash
      $ php artisan make:repository CustomerRepository
      ```

+ 針對 Customer 模組，新增 CustomerRepository
  + 查看 app/Customer.php
    ```php
    <?php
    namespace App;
    use Illuminate\Database\Eloquent\Model;
    use App\Car;

    class Customer extends Model
    {
        // 對應資料表 customers
        protected $table = 'customers';
        protected $primarykey = 'Cusid';
        public $timestamps = true;

        //取得客戶的車牌資料
        public function cars(){
            return $this->hasMany(Car::Class,'Cusid');
        }
    }
    ```

  + 編修 app/Repositories/CustomerRepository.php
    ```php
    <?php
    namespace App\Repositories;

    use App\Customer;

    class CustomerRepository{

        protected $customers;
        /*
        *    creae install for Model
        */
        public function __construct(Customer $custoers){
            $this->customers = $customers;
        }
        // 取得 customers 資料的方法
        public function getAllCustomer(){
            return $this->customers->all();
        }
    }
    ```
+ 修改 CustomerController ，改成使用 Repository 方式取得資料
  + 修改 app/Http/Controllers/CustomerController.php
    ```php
    // 引入 CustomerRepository
    use App\Repositories;
    // 中間略過

    //修改下列function
      protected $customers;
      public function __construct(CustomerRepository $customers){
          $this->customers = $customers;
      }
      //客戶列表
      public function index() {
          $list = $this->customers->getAllCustomer();
          return View::make('board',['customers' => $list]);
      }
    //以下略過
    ```
  + 將資料先 git 上 github
  + 在正式環境中，取得 github 上的檔案
  + 利用瀏覽器查看客戶列表是否正常！

+ 針對 Car 模組，增加 CarRepository 
##### 參考文獻
[laravel 自定義artisan命令](https://www.itread01.com/content/1545264185.html)
[佛祖球球－Repository Pattern and Service Layer](https://blog.johnsonlu.org/repository-pattern-and-service-layer/)