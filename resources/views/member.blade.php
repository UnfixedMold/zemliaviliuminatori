
@push('head')
    <link href="{{ asset('css/toggle.css') }}" rel="stylesheet">
@endpush

@extends('layouts.app')

@section('content')
    <div class="container">
                <div class="card">
                    <div class="card-header">{{ __('Members') }}</div>
                    <form method="POST" action="{{ route('updateMember', $id) }}" class="card-body">
                        @csrf
                        @method("PUT")
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <label for="name" class="col-md-6"><b>Name</b></label>
                                    <div id="name" class="col-md-6">{{ $name  }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <label for="email" class="col-md-6"><b>E-mail</b></label>
                                    <div id="email" class="col-md-6">{{ $email  }}</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <label for="is_admin_check" class="col-md-6"><b>Admin</b></label>
                                    <div class="col-md-6">
                                        <label class="switch">
                                            <input name="is_admin_check" id="is_admin_check" type="checkbox" {!! ($isAdmin) ? "checked" : '' !!}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
    </div>
@endsection


