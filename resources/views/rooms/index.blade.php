@extends('layouts.global')
@section('title') Ruangan @endsection
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
                                <h4>Ruangan</h4>
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
                                <li class="breadcrumb-item"><a href="{{route('houses.show', [$house->id])}}">Ruangan</a>
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
                        <h5>Rumah Tipe {{ $house->house_type }}</h5>
                        <p>Nama Pemilik: {{ $house->name }}</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('houses.show',[$house->id])}}">
                            <div class="form-group row container">
                                <div class="input-group">
                                    <input type="text" id="name" name="keywoard"
                                        placeholder="Filter berdasarkan nama ruangan"
                                        value="{{Request::get('keyword')}}" class="form-control">
                                    <div class="input-group-append">
                                        <input type="submit" value="Filter" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="text-left">
                                    <a href="{{route('houses.estimated_product', [$house->id])}}"
                                        class="btn btn-primary btn-sm">Proses</a>
                                </div>
                                <div class="text-right">
                                    <a href="{{route('rooms.create_room', [$house->id])}}"
                                        class="btn btn-primary btn-sm">Tambah Ruangan</a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Ruangan</th>
                                        <th>Panjang</th>
                                        <th>Lebar</th>
                                        <th>Tinggi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no =1;
                                    @endphp
                                    @foreach ($rooms as $room)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->long }}</td>
                                        <td>{{ $room->wide }}</td>
                                        <td>{{ $room->height }}</td>
                                        <td>
                                            <a href="{{route('rooms.edit',[$room->id])}}"
                                                class="btn btn-info text-white btn-sm">Edit</a>

                                            <form action="{{ route('rooms.destroy',[$room->id]) }}"
                                                onsubmit="return confirm('Hapus data ruangan ini?')" class="d-inline"
                                                method="POST">
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
                                                            href="{{$rooms->previousPageUrl()}}">Previous</a></li>
                                                    @for($i=1;$i<=$rooms->lastPage();$i++)
                                                        @if($i == $rooms->currentPage())
                                                        <li class="page-item active"><a class="page-link"
                                                                href="{{$rooms->url($i)}}">{{$i}} <span
                                                                    class="sr-only">(current)</span></a></li>
                                                        @else
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{$rooms->url($i)}}">{{$i}}</a></li>
                                                        @endif
                                                        @endfor
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{$rooms->nextPageUrl()}}">Next</a></li>
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