@extends('layouts.global')
@section('title') Daftar User @endsection
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
                                <h4>Daftar User</h4>
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
                                <li class="breadcrumb-item"><a href="#!">User</a>
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
                        <h5>Daftar User</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('users.index')}}">
                            <div class="form-group row container">
                                <div class="col-sm-8">
                                    <input type="text" id="name" name="keywoard" placeholder="Filter berdasarkan email"
                                        value="{{Request::get('keyword')}}" class="form-control">
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}}
                                                class="form-control" type="radio" name="status" id="active"
                                                value="ACTIVE">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span class="text-inverse">Active</span>
                                        </label>
                                        <label>
                                            <input {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}}
                                                class="form-control" type="radio" name="status" id="inactive"
                                                value="INACTIVE">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span class="text-inverse">Inactive</span>
                                        </label>
                                    </div>
                                    <input type="submit" value="Filter" class="btn btn-primary">
                                </div>
                                <br>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="text-right">
                                    <a href="{{route('users.create')}}" class="btn btn-primary text-right">Tambah
                                        User</a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Avatar</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no =1;
                                    @endphp
                                    @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->avatar)
                                            <img src="{{ url('public/storage/' . $user->avatar) }}" width="70px" />
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->status =="ACTIVE")
                                            <span class="badge badge-success">
                                                {{ $user->status }}
                                            </span>
                                            @else
                                            <span class="badge badge-danger">
                                                {{ $user->status }}
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('users.edit',[$user->id])}}"
                                                class="btn btn-info text-white btn-sm">Edit</a>

                                            <form action="{{ route('users.destroy',[$user->id]) }}"
                                                onsubmit="return confirm('Hapus user ini?')" class="d-inline"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">

                                            </form>
                                            <a href="{{route('users.show', [$user->id])}}"
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
                                                            href="{{$users->previousPageUrl()}}">Previous</a></li>
                                                    @for($i=1;$i<=$users->lastPage();$i++)
                                                        @if($i == $users->currentPage())
                                                        <li class="page-item active"><a class="page-link"
                                                                href="{{$users->url($i)}}">{{$i}} <span
                                                                    class="sr-only">(current)</span></a></li>
                                                        @else
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{$users->url($i)}}">{{$i}}</a></li>
                                                        @endif
                                                        @endfor
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{$users->nextPageUrl()}}">Next</a></li>
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