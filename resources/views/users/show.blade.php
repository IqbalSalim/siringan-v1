@extends('layouts.global')
@section('title') Edit User @endsection
@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="icofont icofont-table bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Detail User</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="icofont icofont-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">User</a></li>
                                <li class="breadcrumb-item"><a href="#!">Detail User</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail User</h5>
                    </div>
                    <div class="card-block table-border-style">
                        <b>Name:</b> <br />
                        {{$user->name}}
                        <br><br>
                        @if($user->avatar)
                        <img src="{{asset('storage/'. $user->avatar)}}" width="128px" />
                        @else
                        No avatar
                        @endif
                        <br>
                        <br>
                        <b>Username:</b><br>
                        {{$user->email}}
                        <br>
                        <br>
                        <b>Phone number</b> <br>
                        {{$user->phone}}
                        <br><br>
                        <b>Address</b> <br>
                        {{$user->address}}
                        <br>
                        <br>
                        <b>Roles:</b> <br>
                        @foreach (json_decode($user->roles) as $role)
                        &middot; {{$role}} <br>
                        @endforeach
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>

            <div id="styleSelector">

            </div>
        </div>
    </div>
</div>
@endsection