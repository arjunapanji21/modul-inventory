@extends('layouts.main') @section('content')
<div class="grid lg:grid-cols-3 gap-4 py-4">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-between">
                <h2 class="card-title text-4xl">124</h2>
                <h2 class="card-title text-primary text-4xl">
                    <i class="fa-solid fa-box"></i>
                </h2>
            </div>
            <p>Data Barang</p>
            <div class="card-actions justify-end">
                <button class="btn btn-ghost hover:btn-primary">Details</button>
            </div>
        </div>
    </div>
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-between">
                <h2 class="card-title text-4xl">124</h2>
                <h2 class="card-title text-primary text-4xl">
                    <i class="fa-solid fa-arrow-down"></i>
                </h2>
            </div>
            <p>Barang Masuk</p>
            <div class="card-actions justify-end">
                <button class="btn btn-ghost hover:btn-primary">Details</button>
            </div>
        </div>
    </div>
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-between">
                <h2 class="card-title text-4xl">124</h2>
                <h2 class="card-title text-primary text-4xl">
                    <i class="fa-solid fa-arrow-up"></i>
                </h2>
            </div>
            <p>Barang Keluar</p>
            <div class="card-actions justify-end">
                <button class="btn btn-ghost hover:btn-primary">Details</button>
            </div>
        </div>
    </div>
</div>

<div class="py-4">
    <div class="py-4 flex justify-between items-center">
        <div class="text-xl font-bold">Stok Barang Hampir Habis</div>
        <!-- <input
            type="text"
            placeholder="Search"
            class="input input-bordered shadow-xl w-full max-w-xs"
        /> -->
    </div>
    <div class="card bg-base-100 shadow-xl">
        <div class="overflow-auto max-h-[300px]">
            <table class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=1;$i<=5;$i++)
                    <tr>
                        <th>{{ $i }}</th>
                        <td>K000{{ $i }}</td>
                        <td>Jam GSHOCK</td>
                        <td>0</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
