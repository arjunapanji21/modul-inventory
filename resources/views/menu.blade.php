@extends('layouts.main') @section('content')
<div class="grid gap-3">
    <a class="">
        <div class="flex justify-center items-center">
            <div class="avatar online placeholder">
                <div
                    class="bg-primary-focus text-neutral-content rounded-full w-32"
                >
                    <span
                        class="text-4xl"
                        >{{ substr(strtoupper(auth()->user()->name), 0,1) }}</span
                    >
                </div>
            </div>
        </div>
        <div class="card-body text-2xl text-center font-bold capitalize">
            {{ auth()->user()->name }}
        </div>
    </a>
    <div class="divider">Data Barang</div>
    <a href="{{ route('barang.stok') }}" class="card bg-base-100 shadow-xl">
        <div class="flex justify-center items-center">
            <i class="fa-solid text-primary fa-box text-2xl px-10"></i>
            <div class="card-body text-xl">Stok Barang</div>
        </div>
    </a>
    <a href="{{ route('barang.masuk') }}" class="card bg-base-100 shadow-xl">
        <div class="flex justify-center items-center">
            <i class="fa-solid text-primary fa-arrow-down text-2xl px-10"></i>
            <div class="card-body text-xl">Barang Masuk</div>
        </div>
    </a>
    <a href="{{ route('barang.keluar') }}" class="card bg-base-100 shadow-xl">
        <div class="flex justify-center items-center">
            <i class="fa-solid text-primary fa-arrow-up text-2xl px-10"></i>
            <div class="card-body text-xl">Barang Keluar</div>
        </div>
    </a>
    <div class="divider">Laporan</div>
    <a href="" class="card bg-base-100 shadow-xl">
        <div class="flex justify-center items-center">
            <i class="fa-solid text-primary fa-file-invoice text-2xl px-10"></i>
            <div class="card-body text-xl">Stok Akhir</div>
        </div>
    </a>
    <div class="divider">Pengaturan</div>
    <a href="" class="card bg-base-100 shadow-xl">
        <div class="flex justify-center items-center">
            <i class="fa-solid text-primary fa-user text-2xl px-10"></i>
            <div class="card-body text-xl">Data User</div>
        </div>
    </a>
    <a href="" class="card bg-base-100 shadow-xl">
        <div class="flex justify-center items-center">
            <i class="fa-solid text-primary fa-lock text-2xl px-10"></i>
            <div class="card-body text-xl">Ubah Password</div>
        </div>
    </a>
    <a href="{{ route('user.logout') }}" class="card bg-base-100 shadow-xl">
        <div class="flex justify-center items-center">
            <i class="fa-solid text-primary fa-sign-out text-2xl px-10"></i>
            <div class="card-body text-xl">Keluar</div>
        </div>
    </a>
</div>
@endsection
