@extends('layouts.main') @section('content')
<div class="py-2 block lg:flex lg:items-center lg:justify-between">
    <div class="block lg:flex gap-2">
        <div class="form-control">
            <label class="label">
                <span class="label-text">Dari Tanggal</span>
            </label>
            <label class="input-group">
                <span class="bg-primary"
                    ><i class="fa-solid text-primary-content fa-calendar"></i
                ></span>
                <input
                    type="date"
                    class="input input-bordered w-full lg:w-max"
                />
            </label>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Sampai Tanggal</span>
            </label>
            <label class="input-group">
                <span class="bg-primary"
                    ><i class="fa-solid text-primary-content fa-calendar"></i
                ></span>
                <input
                    type="date"
                    class="input input-bordered w-full lg:w-max"
                />
            </label>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">&nbsp;</span>
            </label>
            <label class="btn btn-primary btn-outline bg-base-100"
                >Submit</label
            >
        </div>
    </div>

    <div class="block lg:flex gap-2">
        <div class="form-control">
            <label class="label">
                <span class="label-text">&nbsp;</span>
            </label>
            <input
                id="search"
                type="text"
                placeholder="Search"
                class="input input-bordered w-full lg:w-max"
            />
        </div>
    </div>
</div>

<div id="print-area" class="bg-base-100 rounded-box shadow-xl p-4 mt-2">
    <div class="flex justify-between">
        <label class="btn btn-ghost text-primary"
            ><i class="fa-solid fa-download pr-2"></i> Unduh</label
        >
        <label class="btn btn-ghost text-primary"
            ><i class="fa-solid fa-print pr-2"></i> Cetak</label
        >
    </div>
    <div class="text-center mx-auto pt-5 pb-10">
        <div class="text-2xl font-bold uppercase">Laporan Stok Barang</div>
        <div class="text-2xl font-bold normal-case">
            {{ date("d-m-Y") }} s/d {{ date("d-m-Y") }}
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl">
        <div class="overflow-auto max-h-screen">
            <table class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Merk</th>
                        <th>Stok</th>
                        <th class="text-center">
                            <i class="fa-solid fa-ellipsis"></i>
                        </th>
                    </tr>
                </thead>
                <tbody id="table-search">
                    @for($i=1;$i<=100;$i++)
                    <tr>
                        <th>{{ $i }}</th>
                        <td>K000{{ $i }}</td>
                        <td>Jam GSHOCK</td>
                        <td>GSHOCK</td>
                        <td>10</td>
                        <td class="text-center">
                            <label class="btn btn-ghost btn-sm">Details</label>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
