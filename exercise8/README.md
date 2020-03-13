#### 課後綜合練習(七)
##### 說明
+ 本練習承接上一回的課後綜合練習
+ 本練習只記錄要點，細節部份請自行參閱上課內容
+ 程式範例放置網址 : https://github.com/antallen/PHPproject.git
+ 其餘設定，請參閱上一回的課後綜合練習
+ 請將上回課後練習完成後，才進行本次練習

##### Service 與 Repository 的配合運用
+ 新增 Service 指令
  + 編修 app/Console/Commands/ServiceMakeCommand.php
    ```php
    <?php
    namespace App\Console\Commands;
    use Illuminate\Console\GeneratorCommand;

    class ServiceMakeCommand extends GeneratorCommand
    {
        /**
        * The console command name.
        *
        * @var string
        */
        protected $name = 'make:service';

        /**
        * The console command description.
        *
        * @var string
        */
        protected $description = 'Create a new service class';

        /**
        * The type of class being generated.
        *
        * @var string
        */
        protected $type = 'Service';

        /**
        * Get the stub file for the generator.
        *
        * @return string
        */
        protected function getStub()
        {
            return __DIR__.'/stubs/service.stub';
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
            return $rootNamespace.'\Services';
        }
    }
    ```
  + 編修 app/Console/Commands/stubs/service.stub
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
  + 編修 app/Console/Kernel.php, 註冊 ServiceMakeCommand
    ```php
    //修改下列部份即可
    protected $commands = [
        //建立產生 repository 的命令
        commands\RepositoryMakeCommand::Class,
        //建立產生 service 的命令
        commands\ServiceMakeCommand::Class
    ];
    ```
  + 測試實作
    ```bash
    $ php artisan make:service CarCustomerService
    ```

+ 編修 app/Repositories/CustomerRepository.php
  ```php
  //增加下列新功能
  // 取得特定客戶資料的方法
    public function getOneCustomer($cusid){
        return $this->customers
                    ->where('Cusid','=',$cusid)
                    ->get();
    }
  ```
+ 編修 app/Services/CarCustomerService.php
  ```php
  <?php
    namespace App\Services;

    use App\Repositories\CarRepository;
    use App\Repositories\CustomerRepository;

    class CarCustomerService
    {
        protected $customers;
        protected $cars;
        /*
        *    creae install for Model
        */
        public function __construct(CarRepository $cars, CustomerRepository $customers)
        {
            $this->customers = $customers;
            $this->cars = $cars;
        }

        //取得特定車主與車輛資料
        public function getCars($Cusid){
            return [
                'customer' => $this->customers->getOneCustomer($Cusid),
                'cars' => $this->cars->getAllCar($Cusid)
            ];
        }
    }
  ```
+ 編修 app/Http/Controllers/CarController.php
  ```php
  //修改下列項目
  //use App\Repositories\CarRepository;
  use App\Services\CarCustomerService;
  // 中間略過
  //protected $cars;
    protected $CarCustomerService;

    //public function __construct(CarRepository $cars){
    public function __construct(CarCustomerService $CarCustomerService){
        //$this->cars = $cars;
        $this->CarCustomerService = $CarCustomerService;
    }
    // 一堆中間略過
    //顯示車主所擁有的車輛
    public function index(Request $request) {
        if ($request->has('Cusid')){

            $list=$this->CarCustomerService->getCars($request->Cusid);
            $customer=$list['customer'];
            $cars=$list['cars'];
            return View::make('car',['customer'=>$customer,'cars'=>$cars]);
        } else {
    // 以下略過
  ```
+ 將資料 git 上 github
+ 在正式環境中，取得 github 上的檔案
+ 利用瀏覽器查看客戶的車輛列表是否正常！

##### 心法註記
+ 基本表格對應的部份，交給 Repository !!
+ 利用 Service 整合多個 Repository ，提供給 Controller Function !!
+ Controller 直接使用 Service，提供 View 資料 ！