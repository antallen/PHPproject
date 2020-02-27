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