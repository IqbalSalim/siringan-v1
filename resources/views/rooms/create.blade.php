@extends('layouts.global');
@section('title') Tambah Ruangan @endsection
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
                                <h4>Tambah Ruangan</h4>
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
                                        Penerangan</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('houses.show',[$house->id]) }}">Detail
                                        Rumah</a></li>
                                <li class="breadcrumb-item">Tambah Ruangan</li>
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
                <form action="{{ route('rooms.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="house_id" value="{{ $house->id }}">
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Ruangan</h5>
                        </div>
                        <div class="card-block">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="categories">Ketegori Ruangan</label>
                                <div class="col-sm-10">
                                    <select id="categories" data-foo="true" name="categories"
                                        class="form-control"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Ruangan</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" name="name" placeholder="Nama Ruangan"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Panjang</label>
                                <div class="col-sm-10">
                                    <input type="number" step=".01" id="long" name="long" placeholder="Panjang (meter)"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Lebar</label>
                                <div class="col-sm-10">
                                    <input type="number" id="wide" step=".01" name="wide" placeholder="Lebar (meter)"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tinggi</label>
                                <div class="col-sm-10">
                                    <input type="number" id="height" step=".01" name="height"
                                        placeholder="Tinggi (meter)" class="form-control">
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
        </div>
    </div>
</div>
@endsection
@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#categories').select2({
        ajax: {
            url: 'http://siringan.test/ajax/categories/search',
            processResults: function(data){
                return {
                results: data.map(function(item){return {id: item.id, text:
                item.info} })
                }
            }
        }
    });
</script>
@endsection