<?php
?>
@extends('layouts.app')

@section('content')

    <h1>mails-to-excel</h1>
    {{Form::open(['method'=>'POST', 'route'=>'mails-to-excel.convert','files'=>true])}}

    @include('forms._file', [
    'name'=>'file',
    'label'=>'CSV'
    ])

    <button class="btn btn-success">Конвертировать</button>

    {{Form::close()}}

@stop
