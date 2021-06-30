@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Возможности</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-outline-secondary" href="{{route('mails-to-excel.index')}}">
                                    mails-to-excel
                                </a>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-outline-secondary" href="{{route('csv-to-vcf.index')}}">
                                    csv-to-vcf
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
