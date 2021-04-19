@extends('layouts.global')
@section('title') Detail Barang @endsection
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
                                <h4>Detail Barang</h4>
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
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Barang</a></li>
                                <li class="breadcrumb-item">Detail Barang</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Barang</h5>
                    </div>
                    <div class="card-body">
                        <b>Nama Barang:</b> <br />
                        {{$product->name}}
                        <br>
                        <br>
                        <b>Harga:</b><br>
                        {{$product->price}}
                        <br>
                        <br>
                        <b>Merek:</b> <br>
                        {{$product->brand}}
                        <br><br>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection