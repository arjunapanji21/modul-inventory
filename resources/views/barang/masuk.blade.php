@extends('layouts.main') @section('content')
<div class="py-2">
    <input
        id="search"
        type="text"
        placeholder="Search"
        class="input input-bordered w-full"
    />
</div>
<div class="card bg-base-100 shadow-xl">
    <div class="overflow-auto max-h-screen">
        <table class="table table-zebra w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Barang</th>
                    <td>Stok Awal</td>
                    <th>Tgl. Masuk</th>
                    <th>Jumlah</th>
                    <th>Stok Akhir</th>
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
                    <td>10</td>
                    <td>{{ date('d M Y H:i:s') }}</td>
                    <td>2</td>
                    <td>12</td>
                    <td class="text-center">
                        <label class="btn btn-ghost btn-sm">Details</label>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection
