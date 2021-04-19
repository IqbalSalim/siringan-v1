@extends('layouts.global')
@section('title') Daftar Barang @endsection
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
                                <h4>Daftar Barang</h4>
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
                                <li class="breadcrumb-item"><a href="#!">Barang</a>
                                </li>
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
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Barang</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('products.index')}}">
                            <div class="form-group row container">
                                <div class="input-group col-sm-8">
                                    <input type="text" id="name" name="keywoard"
                                        placeholder="Filter berdasarkan nama barang" value="{{Request::get('keyword')}}"
                                        class="form-control">
                                    <div class="input-group-append">
                                        <input type="submit" value="Filter" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="nav nav-pills card-header-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="
                                        {{route('products.index')}}">Published</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="
                                        {{route('products.trash')}}">Trash</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="text-right">
                                    <a href="{{route('products.create')}}" class="btn btn-primary text-right">Tambah
                                        Barang</a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Merek</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no =1;
                                    @endphp
                                    @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->brand }}</td>

                                        <td>
                                            <a href="{{route('products.edit',[$product->id])}}"
                                                class="btn btn-info text-white btn-sm">Edit</a>

                                            <form action="{{ route('products.destroy',[$product->id]) }}"
                                                onsubmit="return confirm('Hapus barang ini?')" class="d-inline"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">

                                            </form>
                                            <a href="{{route('products.show', [$product->id])}}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">
                                            {{ $products->appends(Request::all())->links() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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