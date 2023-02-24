@extends('layouts.main') @section('content')
<div class="grid lg:grid-cols-3 gap-4 py-4">
    @if(auth()->user()->role != "Owner")
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-between">
                <h2 class="card-title text-4xl">
                    {{ number_format($data_barang) }}
                </h2>
                <h2 class="card-title text-primary text-4xl">
                    <i class="fa-solid fa-box"></i>
                </h2>
            </div>
            <p>Data Barang</p>
            <div class="card-actions justify-end">
                <a
                    href="{{ route('barang.stok') }}"
                    class="btn btn-ghost hover:btn-primary"
                    >Details</a
                >
            </div>
        </div>
    </div>
    @endif @if(auth()->user()->role == "Admin")
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-between">
                <h2 class="card-title text-4xl">
                    {{ number_format($data_masuk) }}
                </h2>
                <h2 class="card-title text-primary text-4xl">
                    <i class="fa-solid fa-arrow-down"></i>
                </h2>
            </div>
            <p>Barang Masuk</p>
            <div class="card-actions justify-end">
                <a
                    href="{{ route('barang.masuk') }}"
                    class="btn btn-ghost hover:btn-primary"
                    >Details</a
                >
            </div>
        </div>
    </div>
    @endif @if(auth()->user()->role != "Owner")
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-between">
                <h2 class="card-title text-4xl">
                    {{ number_format($data_keluar) }}
                </h2>
                <h2 class="card-title text-primary text-4xl">
                    <i class="fa-solid fa-arrow-up"></i>
                </h2>
            </div>
            <p>Barang Keluar</p>
            <div class="card-actions justify-end">
                <a
                    href="{{ route('barang.keluar') }}"
                    class="btn btn-ghost hover:btn-primary"
                    >Details</a
                >
            </div>
        </div>
    </div>
    @endif
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <div class="card-title">Statistik Barang Masuk</div>
            <div id="chart1"></div>
        </div>
    </div>
    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <div class="card-title">Statistik Barang Keluar</div>
            <div id="chart2"></div>
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
                    @if($stok_habis->count() > 0) @foreach($stok_habis as $row)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row->kode }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->stok }}</td>
                    </tr>
                    @endforeach @else
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection @section('script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        series: @JSON($stat_masuk['jumlah']),
        chart: {
            type: "pie",
        },
        labels: @JSON($stat_masuk['kategori']),
        responsive: [
            {
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                    },
                    legend: {
                        position: "bottom",
                    },
                },
            },
        ],
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
</script>
<script>
    var options = {
        series: @JSON($stat_keluar['jumlah']),
        chart: {
            type: "pie",
        },
        labels: @JSON($stat_keluar['kategori']),
        responsive: [
            {
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                    },
                    legend: {
                        position: "bottom",
                    },
                },
            },
        ],
    };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();
</script>
@endsection
