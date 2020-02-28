#### 課後綜合練習(五)
##### 說明
+ 本練習承接上一回的課後綜合練習
+ 本練習只記錄要點，細節部份請自行參閱上課內容
+ 程式範例放置網址 : https://github.com/antallen/PHPproject.git
+ 其餘設定，請參閱上一回的課後綜合練習

##### 資料驗證實作
+ 新增表單驗證功能
  + 使用開發環境
  + 利用 artisaan 的 make:request 來快速建立一個 Form Request
    ```bash
    $ php artisan make:request EditCustomer
    ```
  + 編修 app/Http/Requests/EditCustomer.php
    ```php
    <?php
    namespace App\Http\Requests;
    use Illuminate\Foundation\Http\FormRequest;
    class EditCustomer extends FormRequest {
        public function authorize()
        {
            //因為無身份驗證，暫時將 false 改成 true
            return true;
        }
        //表單驗證規則
        public function rules()
        {
            return [
                'Cusid'=>'required|string',
                'Name'=>'required|string',
                'Address'=>'required|string',
                'Phone' => 'required|string'
            ];
        }
        //自訂錯誤訊息
        public function messages(){
            return [
            'required' => '不可為空白',
            'string' => '必須為字串'
            ];
        }
    }
    ```
  + 編修 app/Http/Controllers/CustomerController.php
    ```php
    //增加下列一行
    use App\Http\Requests\EditCustomer;
    //修改 update function
    public function update(EditCustomer $request){
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
        return View::make('board',['customers' => $customers,'msg' => '修改成功']); 
    }
    ```
  + 修改 resources/views/edit.blade.php
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
              @isset($msg)
              <div class="alert alert-success" role="alert">
                  {{ $msg ?? '沒有任何訊息'}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endisset
              <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <label for="Cusid" class="col-sm-2 col-form-label">客戶編號</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control {{ $errors->has('Cusid') ? 'is-invalid' : '' }}" id="Cusid" name="Cusid" value="{{ $Cusid }}">
                      @if ($errors->has('Cusid'))
                          <div class="invalid-feedback">
                              <strong>{{ $errors->first('Cusid')}}</strong>
                          </div>
                      @endif
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <label for="Name" class="col-sm-2 col-form-label">客戶姓名</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control {{ $errors->has('Name') ? 'is-invalid' : '' }}" id="Name" name="Name" value="{{ $Name }}">
                      @if ($errors->has('Name'))
                          <div class="invalid-feedback">
                              <strong>{{ $errors->first('Name')}}</strong>
                          </div>
                      @endif
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <label for="Address" class="col-sm-2 col-form-label">通訊地址</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control {{ $errors->has('Address') ? 'is-invalid' : '' }}" id="Address" name="Address" value="{{ $Address }}">
                      @if ($errors->has('Address'))
                          <div class="invalid-feedback">
                              <strong>{{ $errors->first('Address')}}</strong>
                          </div>
                      @endif
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <label for="Phone" class="col-sm-2 col-form-label">連絡電話</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control {{ $errors->has('Phone') ? 'is-invalid' : '' }}" id="Phone" name="Phone" value="{{ $Phone }}">
                      @if ($errors->has('Phone'))
                          <div class="invalid-feedback">
                              <strong>{{ $errors->first('Phone')}}</strong>
                          </div>
                      @endif
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-9">
                      <input type="submit" class="btn btn-primary" value="送出">
                      <input type="hidden" id="oldId" name="oldId"  value="{{ $Cusid }}">
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
  + 存檔後，傳送至 github
  + 到正式環境下載更新專案

##### 練習時間
+ 請將需要填入或更新資料的表單，加入表單驗證功能！