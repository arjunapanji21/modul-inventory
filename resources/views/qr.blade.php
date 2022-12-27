@if(Auth::check())
@extends('layouts.main') @section('content')
<div class="">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <img
                class="mx-auto"
                src="{{ asset($barang->gambar) }}"
                alt="gambar-barang"
                width="200"
            />
            <div class="overflow-auto my-4">
                <table class="table table-zebra w-full table-compact">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kode Barang</td>
                            <td>:</td>
                            <td>{{ $barang->kode }}</td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td>:</td>
                            <td>{{ $barang->nama }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>{{ $barang->kategori->nama }}</td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td>:</td>
                            <td class="font-bold">{{ $barang->stok }}</td>
                        </tr>
                        <tr>
                            <td>Terakhir Update</td>
                            <td>:</td>
                            <td>{{ $barang->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@else
<div class="">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <img
                class="mx-auto"
                src="{{ asset($barang->gambar) }}"
                alt="gambar-barang"
                width="200"
            />
            <div class="overflow-auto my-4">
                <table class="table table-zebra w-full table-compact">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kode Barang</td>
                            <td>:</td>
                            <td>{{ $barang->kode }}</td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td>:</td>
                            <td>{{ $barang->nama }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>{{ $barang->kategori->nama }}</td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td>:</td>
                            <td class="font-bold">{{ $barang->stok }}</td>
                        </tr>
                        <tr>
                            <td>Terakhir Update</td>
                            <td>:</td>
                            <td>{{ $barang->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
