@extends('layouts.main') @section('content')
<div class="card max-w-md mx-auto bg-base-100">
    <div class="card-body">
        <div class="max-w-md mx-auto">
            <form
                action="{{ route('barang.update') }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf @method('put')
                <h3 class="font-bold text-lg">Edit Data Barang</h3>
                <input hidden type="text" name="id" value="{{ $barang->id }}" />
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
                            value="{{ $barang->kode }}"
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
                            value="{{ $barang->nama }}"
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
                        @foreach($kategori as $row) @if($row->id ==
                        $barang->kategori_id)
                        <option selected value="{{ $row->id }}">
                            {{ $row->nama }}
                        </option>
                        @else
                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                        @endif @endforeach
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
                        name="gambar"
                        type="file"
                        class="file-input file-input-bordered w-full"
                    />
                </div>
                <div class="modal-action">
                    <a href="{{ route('barang.stok') }}" class="btn btn-ghost"
                        >Batal</a
                    >
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
