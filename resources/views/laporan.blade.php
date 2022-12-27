@extends('layouts.main') @section('content')
<div class="py-2 block lg:flex lg:items-center lg:justify-between">
    <form action="{{ route('laporan') }}" method="get">
        @csrf
        <div class="block lg:flex gap-2">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Dari Tanggal</span>
                </label>
                <label class="input-group">
                    <span class="bg-primary"
                        ><i
                            class="fa-solid text-primary-content fa-calendar"
                        ></i
                    ></span>
                    <input
                        name="from"
                        type="date"
                        class="input input-bordered w-full lg:w-max"
                        value="{{ $from }}"
                    />
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Sampai Tanggal</span>
                </label>
                <label class="input-group">
                    <span class="bg-primary"
                        ><i
                            class="fa-solid text-primary-content fa-calendar"
                        ></i
                    ></span>
                    <input
                        name="to"
                        type="date"
                        class="input input-bordered w-full lg:w-max"
                        value="{{ $to }}"
                    />
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">&nbsp;</span>
                </label>
                <button
                    type="submit"
                    class="btn btn-primary btn-outline bg-base-100"
                >
                    Submit
                </button>
            </div>
        </div>
    </form>

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
        <form action="{{ route('laporan.export') }}" method="get">
            <input type="text" name="from" value="{{ $from }}" hidden />
            <input type="text" name="to" value="{{ $to }}" hidden />
            @csrf
            <button type="submit" class="btn btn-ghost text-primary">
                <i class="fa-solid fa-download pr-2"></i> Unduh
            </button>
        </form>
        <form
            action="{{ route('laporan.print') }}"
            target="_blank"
            method="get"
        >
            <input type="text" name="from" value="{{ $from }}" hidden />
            <input type="text" name="to" value="{{ $to }}" hidden />
            @csrf
            <button type="submit" class="btn btn-ghost text-primary">
                <i class="fa-solid fa-print pr-2"></i> Cetak
            </button>
        </form>
    </div>
    <div class="text-center mx-auto pt-5 pb-10">
        <div class="text-2xl font-bold uppercase">Laporan Stok Barang</div>
        <div class="text-2xl font-bold normal-case">
            {{ date("d F Y", strtotime($from)) }} -
            {{ date("d F Y", strtotime($to)) }}
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl">
        <div class="overflow-auto max-h-screen">
            <table class="table table-zebra w-full to-print">
                <!-- head -->
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th class="text-right">Stok Awal</th>
                        <th class="text-right">Masuk</th>
                        <th class="text-right">Keluar</th>
                        <th class="text-right">Stok Akhir</th>
                    </tr>
                </thead>
                <tbody id="table-search">
                    @foreach($data as $row)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row->kode }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->kategori->nama }}</td>
                        <td class="text-right">
                            {{ number_format($row->stok_awal) }}
                        </td>
                        <td class="text-right">
                            {{ number_format($row->masuk) }}
                        </td>
                        <td class="text-right">
                            {{ number_format($row->keluar) }}
                        </td>
                        <td class="text-right font-bold">
                            {{ number_format($row->stok_akhir) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
