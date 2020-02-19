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