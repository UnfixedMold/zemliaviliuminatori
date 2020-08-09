@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <b class="col-md-6">Name</b>
                                    <div class="col-md-6">{{ $name  }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <b class="col-md-6">E-mail</b>
                                    <div class="col-md-6">{{ $email  }}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
