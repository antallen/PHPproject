@extends('layouts.master')
@section('title','客戶列表')
@section('content')
<div class="row justify-content-center">
<div class="col-md-10">
    <div class="card">
    <div class="card-header">客戶列表</div>
    <div class="card-body p-1">
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
    </div>  
    </div>
</div>
</div>
@stop