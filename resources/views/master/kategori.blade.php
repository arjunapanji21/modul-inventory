@extends('layouts.main') @section('content')
<div class="py-2 flex gap-2">
    <input
        id="search"
        type="text"
        placeholder="Search"
        class="input input-bordered w-full"
    />
    <label for="tambah-kategori" class="btn btn-primary"
        >Buat Kategori Baru</label
    >
</div>
<input type="checkbox" id="tambah-kategori" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <form action="{{ route('master.kategori.create') }}" method="post">
            @csrf
            <h3 class="font-bold text-lg">Buat Kategori Baru</h3>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama Kategori</span>
                </label>
                <input
                    name="nama"
                    type="text"
                    placeholder="Nama Kategori"
                    class="input input-bordered w-full"
                />
                <label class="label">
                    <span class="label-text-alt text-error"
                        >Field tidak boleh kosong</span
                    >
                </label>
            </div>
            <div class="modal-action">
                <label for="tambah-kategori" class="btn btn-ghost">Batal</label>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="card bg-base-100 shadow-xl">
    <div class="overflow-auto max-h-[400px]">
        <table class="table table-zebra w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th class="text-center">Jumlah Barang</th>
                    <th class="text-center">
                        <i class="fa-solid fa-ellipsis"></i>
                    </th>
                </tr>
            </thead>
            <tbody id="table-search">
                @if($kategori->count() > 0) @foreach($kategori as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama }}</td>
                    <td class="text-center">{{ $row->barang->count() }}</td>
                    <td class="text-center">
                        <label
                            class="btn btn-square btn-outline btn-sm"
                            for="edit-kategori-{{ $row->id }}"
                            ><i class="fa-solid fa-pen"></i
                        ></label>
                        <label
                            class="btn btn-square btn-outline btn-sm btn-error"
                            for="hapus-kategori-{{ $row->id }}"
                            ><i class="fa-solid fa-trash"></i
                        ></label>
                    </td>
                    <!-- Modal Edit -->
                    <input
                        type="checkbox"
                        id="edit-kategori-{{ $row->id }}"
                        class="modal-toggle"
                    />
                    <div class="modal">
                        <div class="modal-box">
                            <form
                                action="{{ route('master.kategori.update', $row->id) }}"
                                method="post"
                            >
                                @csrf @method('put')
                                <h3 class="font-bold text-lg">Edit Kategori</h3>
                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text"
                                            >Nama Kategori</span
                                        >
                                    </label>
                                    <input
                                        name="nama"
                                        type="text"
                                        placeholder="Nama Kategori"
                                        class="input input-bordered w-full"
                                        value="{{ $row->nama }}"
                                    />
                                    <label class="label">
                                        <span class="label-text-alt text-error"
                                            >Field tidak boleh kosong</span
                                        >
                                    </label>
                                </div>
                                <div class="modal-action">
                                    <label
                                        for="edit-kategori-{{ $row->id }}"
                                        class="btn btn-ghost"
                                        >Batal</label
                                    >
                                    <button class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Hapus -->
                    <input
                        type="checkbox"
                        id="hapus-kategori-{{ $row->id }}"
                        class="modal-toggle"
                    />
                    <div class="modal">
                        <div class="modal-box">
                            <form
                                action="{{ route('master.kategori.hapus') }}"
                                method="post"
                            >
                                @csrf @method('delete')
                                <h3 class="font-bold text-lg">
                                    Hapus {{ $row->nama }} Dari Kategori ?
                                </h3>
                                <input
                                    readonly
                                    type="hidden"
                                    value="{{ $row->id }}"
                                    name="id"
                                />
                                <div class="modal-action">
                                    <label
                                        for="hapus-kategori-{{ $row->id }}"
                                        class="btn btn-primary"
                                        >Batal</label
                                    >
                                    <button
                                        type="submit"
                                        class="btn btn-error btn-outline"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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
@endsection
