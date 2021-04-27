@extends('layouts.global')
@section('title') Instalasi Penerangan @endsection
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
                                <h4>Instalasi Penerangan</h4>
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
                                <li class="breadcrumb-item"><a href="{{ route('houses.index') }}">Instalasi
                                        Penerangan</a>
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
                        <h5>Daftar Rumah</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('houses.index')}}">
                            <div class="form-group row container">
                                <div class="input-group">
                                    <input type="text" id="name" name="keywoard"
                                        placeholder="Filter berdasarkan nama pemilik"
                                        value="{{Request::get('keyword')}}" class="form-control">
                                    <div class="input-group-append">
                                        <input type="submit" value="Filter" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="text-right">
                                    <a href="{{route('houses.create')}}" class="btn btn-primary text-right">Tambah
                                        Rumah</a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pemilik</th>
                                        <th>Tipe Rumah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no =1;
                                    @endphp
                                    @foreach ($houses as $house)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $house->name }}</td>
                                        <td>{{ $house->house_type }}</td>
                                        <td>
                                            <a href="{{route('houses.edit',[$house->id])}}"
                                                class="btn btn-info text-white btn-sm">Edit</a>

                                            <form action="{{ route('houses.destroy',[$house->id]) }}"
                                                onsubmit="return confirm('Hapus data rumah ini?')" class="d-inline"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">

                                            </form>
                                            <a href="{{route('houses.show', [$house->id])}}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{$houses->previousPageUrl()}}">Previous</a></li>
                                                    @for($i=1;$i<=$houses->lastPage();$i++)
                                                        @if($i == $houses->currentPage())
                                                        <li class="page-item active"><a class="page-link"
                                                                href="{{$houses->url($i)}}">{{$i}} <span
                                                                    class="sr-only">(current)</span></a></li>
                                                        @else
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{$houses->url($i)}}">{{$i}}</a></li>
                                                        @endif
                                                        @endfor
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{$houses->nextPageUrl()}}">Next</a></li>
                                                </ul>
                                            </nav>
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