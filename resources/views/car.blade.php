@extends('layouts.master')
@section('title','客戶車輛列表')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
    <div class="card">
        <div class="card-header">客戶: {{ $customer[0]->Name }} 車輛清單
            <a href="{{ action('CarController@new',['Cusid'=>$customer[0]->Cusid]) }}" class="col-md-10 text-right">新增車輛</a>
        </div>
        <div class="card-body p-1">
            <table class="table table-hover m-0">
                <thead class="thead-darty">
                <tr>
                    <th>車牌號碼</th>
                    <th>車輛款示</th>
                    <th>資料處理</th>
                </tr>
                </thead>
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
            </table>
        </div>  
    </div>
    </div>
</div>
@stop