@extends('template')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(Session::get("message") && Session::get("class"))
                <p class="alert alert-{{Session::get('class')}} text-center">{{ Session::get("message") }}</p>
            @endif
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="#" class="card-link">
                <div class="card bg-primary text-white shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-uppercase">
                                    A
                                </div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="#" class="card-link">
                <div class="card bg-success text-white shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-uppercase">
                                    B
                                </div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="#" class="card-link">
                <div class="card bg-dark text-white shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-uppercase">
                                    C
                                </div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="#" class="card-link">
                <div class="card bg-danger text-white shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-uppercase">
                                    D
                                </div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection