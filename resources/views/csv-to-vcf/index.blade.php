<?php
?>
@extends('layouts.app')

@section('content')

    <h1>csv-to-vcf</h1>
    {{Form::open(['method'=>'POST', 'route'=>'csv-to-vcf.convert','files'=>true])}}

    @include('forms._file', [
    'name'=>'file',
    'label'=>'CSV'
    ])

    <button class="btn btn-success">Конвертировать</button>

    {{Form::close()}}

@stop
