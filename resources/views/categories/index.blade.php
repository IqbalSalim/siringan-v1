@extends('layouts.global')
@section('title') Kategori Ruangan @endsection
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
                                <h4>Kategori Ruangan</h4>
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
                                        Ruangan</a>
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
                        <h5>Daftar Kategori</h5>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="text-right">
                                <a href="{{route('categories.create')}}" class="btn btn-primary btn-sm">Tambah
                                    Ruangan</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Kategori</th>
                                        <th class="w-25 t-wrap">Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no =1;
                                    @endphp
                                    @foreach ($categories as $category)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->info }}</td>
                                        <td>
                                            <a href="{{route('categories.edit',[$category->id])}}"
                                                class="btn btn-info text-white btn-sm">Edit</a>

                                            <form action="{{ route('categories.destroy',[$category->id]) }}"
                                                onsubmit="return confirm('Hapus kategori ruangan ini?')"
                                                class="d-inline" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
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
                                                            href="{{$categories->previousPageUrl()}}">Previous</a></li>
                                                    @for($i=1;$i<=$categories->lastPage();$i++)
                                                        @if($i == $categories->currentPage())
                                                        <li class="page-item active"><a class="page-link"
                                                                href="{{$categories->url($i)}}">{{$i}} <span
                                                                    class="sr-only">(current)</span></a></li>
                                                        @else
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{$categories->url($i)}}">{{$i}}</a></li>
                                                        @endif
                                                        @endfor
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{$categories->nextPageUrl()}}">Next</a></li>
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