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
                            <i class="ti-layout-grid2-alt bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Tambah User</h4>
                                {{-- <span>Rancangan Anggaran Biaya <code>(RAB)</code>Instalasi Penerangan</span> --}}
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
                                <li class="breadcrumb-item">Tambah User</li>
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
                <form action="{{ route('users.update', [$user->id]) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" value="PUT" name="_method">
                    <div class="card">
                        <div class="card-header">
                            <h5>Form User</h5>
                            {{-- <span>silahkan memilih <code>tipe rumah</code>, <code>jumlah ruangan</code> dan
                                <code>ukuran</code></span> --}}
                        </div>
                        <div class="card-block">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" name="name" placeholder="Nama Lengkap"
                                        value="{{ $user->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $user->username }}" name="username" id="username"
                                        placeholder="Username" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10 ">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input {{ $user->status == 'ACTIVE' ? 'checked' : '' }} class="form-control"
                                                type="radio" name="status" id="active" value="ACTIVE">
                                            <span class="cr"><i
                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Active</span>
                                        </label>
                                        <label>
                                            <input {{ $user->status == 'INACTIVE' ? 'checked' : '' }}
                                                class="form-control" type="radio" name="status" id="inactive"
                                                value="INACTIVE">
                                            <span class="cr"><i
                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Inactive</span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Roles</label>
                                <div class="col-sm-10 ">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input {{in_array("ADMIN", json_decode($user->roles)) ?
                                            "checked" : ""}} class="form-control" type="checkbox" name="roles[]"
                                                id="ADMIN" value="ADMIN">
                                            <span class="cr"><i
                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Administrator</span>
                                        </label>
                                        <label>
                                            <input {{in_array("PELANGGAN", json_decode($user->roles)) ?
                                            "checked" : ""}} class="form-control" type="checkbox" name="roles[]"
                                                id="PELANGGAN" value="PELANGGAN">
                                            <span class="cr"><i
                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Pelanggan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input name="phone" type="text" id="phone" placeholder="Nomor Telepon"
                                        class="form-control" value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea type="text" id="address" name="address" class="form-control">{{ $user->address }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Foto Profile</label>
                                <div class="col-sm-10">
                                    Current avatar:
                                    @if($user->avatar)
                                    <img src="{{asset('storage/a5UiMDh4LehtqcrWXhEtNH89C6aCjBIkB8QtD3zr.jpg')}}"
                                        width="120px" />
                                    <br>
                                    @else
                                    No avatar
                                    @endif
                                    <input type="file" id="avatar" name="avatar" class="form-control">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                        foto profil</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" id="email" name="email" placeholder="user@email.com"
                                        class="form-control" value="{{$user->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button class="btn btn-success"><i
                                            class="icofont icofont-check-circled"></i>Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div id="styleSelector">

            </div>
        </div>
    </div>
</div>
@endsection