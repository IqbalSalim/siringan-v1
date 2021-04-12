@extends('layouts.global')
@section('title') Dashboard @endsection

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-body">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="carousel-container">
                                <h2 class="animated fadeInDown text-center">Tujuan Pembuatan
                                </h2>
                                <p class="animated fadeInUp text-center">Perhitungan
                                    Rekapitulasi Anggaran Biaya yang masih menelan waktu yang
                                    relatif lama</p>
                                <p class="animated fadeInUp text-center">Kurang terpadunya ilmu
                                    tentang bahan instalasi listrik</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-container">
                                <h2 class="animated fadeInDown text-center">Manfaat Aplikasi
                                </h2>
                                <p class="animated fadeInUp text-center">Dapat dijadikan suatu
                                    referensi untuk perancangan anggaran instalasi rumahan</p>
                                <p class="animated fadeInUp text-center">Menjadi salah satu
                                    pembanding untuk penelitian lainnya yang berhubungan dengan
                                    Rancangan Anggaran Instalasi Rumah Hunian</p>
                                <p class="animated fadeInUp text-center">Mempermudah pelanggan
                                    dalam menghitung biaya instalasi listrik</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>


            </div>

            <div id="styleSelector">

            </div>
        </div>
    </div>
</div>
@endsection