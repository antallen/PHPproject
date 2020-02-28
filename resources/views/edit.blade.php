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