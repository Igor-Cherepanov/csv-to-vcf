<?php
?>
@extends('layouts.app')

@section('content')

    {{Form::open(['method'=>'POST', 'route'=>'convert','files'=>true])}}

    @include('forms._file', [
    'name'=>'file',
    'label'=>'CSV'
    ])

    <button class="btn btn-success">Конвертировать</button>

    {{Form::close()}}

@stop
