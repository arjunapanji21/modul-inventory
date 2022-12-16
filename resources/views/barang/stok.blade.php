@extends('layouts.main') @section('content')
<div class="py-2 flex gap-2">
    <input
        id="search"
        type="text"
        placeholder="Search"
        class="input input-bordered w-full"
    />
    @if(auth()->user()->role == "Admin")
    <label for="tambah-barang" class="btn btn-primary"
        >Tambah Data Barang</label
    >
    @endif
</div>
<input type="checkbox" id="tambah-barang" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <form action="{{ route('barang.tambah') }}" method="post">
            @csrf
            <h3 class="font-bold text-lg">Tambah Data Barang</h3>
            <div class="grid grid-cols-3 gap-2">
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Kode Barang</span>
                    </label>
                    <input
                        name="kode"
                        type="text"
                        placeholder="Kode Barang"
                        class="input input-bordered w-full"
                    />
                    <label class="label">
                        <span class="label-text-alt text-error"
                            >Field tidak boleh kosong</span
                        >
                    </label>
                </div>
                <div class="form-control col-span-2 w-full">
                    <label class="label">
                        <span class="label-text">Nama Barang</span>
                    </label>
                    <input
                        name="nama"
                        type="text"
                        placeholder="Nama Barang"
                        class="input input-bordered w-full"
                    />
                    <label class="label">
                        <span class="label-text-alt text-error"
                            >Field tidak boleh kosong</span
                        >
                    </label>
                </div>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Kategori</span>
                </label>
                <select
                    name="kategori_id"
                    class="select select-bordered w-full"
                >
                    <option disabled selected>Pilih Kategori</option>
                    @foreach($kategori as $row)
                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                    @endforeach
                </select>
                <label class="label">
                    <span class="label-text-alt text-error"
                        >Field tidak boleh kosong</span
                    >
                </label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Upload Gambar</span>
                </label>
                <input
                    type="file"
                    class="file-input file-input-bordered w-full"
                />
            </div>
            <div class="modal-action">
                <label for="tambah-barang" class="btn btn-ghost">Batal</label>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
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
                    <th>Kategori</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">
                        <i class="fa-solid fa-ellipsis"></i>
                    </th>
                </tr>
            </thead>
            <tbody id="table-search">
                @if($barang->count() > 0) @foreach($barang as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->kode }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->kategori->nama }}</td>
                    <td class="text-center">{{ $row->stok }}</td>
                    <td class="text-center">
                        <a
                            class="btn btn-ghost btn-sm"
                            href="{{ route('barang.detail', $row->id) }}"
                            >Detail</a
                        >
                    </td>
                </tr>
                @endforeach @else
                <tr>
                    <td colspan="6" class="text-center">Tidak Ada Data</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
