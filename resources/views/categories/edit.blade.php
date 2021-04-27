@extends('layouts.global');
@section('title') Edit Kategori Ruangan @endsection
@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ti-layout-grid2-alt bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Edit Kategori Ruangan</h4>
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
                                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori
                                        Ruangan</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('categories.create') }}">Edit Kategori
                                        Ruangan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
                @endif
                <form action="{{ route('categories.update',[$category->id]) }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <input type="hidden" value="PUT" name="_method">
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Kategori Ruangan</h5>
                        </div>
                        <div class="card-block">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $category->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" id="info" name="info" value="{{ $category->info }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button class="btn btn-success"><i
                                            class="icofont icofont-check-circled"></i>Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection