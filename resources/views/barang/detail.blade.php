@extends('layouts.main') @section('content')
<div class="max-w-md mx-auto">
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
            <a
                href="{{ route('barang.edit', $barang->id) }}"
                class="btn btn-outline"
                >Edit</a
            >
            <div class="card-actions justify-between">
                <div class="flex gap-2">
                    <a href="{{ route('barang.stok') }}" class="btn btn-primary"
                        >Kembali</a
                    >
                    @if(auth()->user()->role == "Admin")
                    <label
                        for="hapus-barang"
                        class="btn btn-error btn-square btn-outline"
                        ><i class="fa-solid fa-trash"></i
                    ></label>
                    @endif
                </div>
                <a
                    download="{{ $barang->kode . ' - ' . $barang->nama . ' QR-Code' }}"
                    href="data:image/png;base64,{{ DNS2D::getBarcodePNG(route('barang.detail.public', $barang->id), 'QRCODE',15,15) }}"
                    target="_blank"
                    class="btn btn-primary btn-outline"
                    >Unduh QR-Code</a
                >
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Barang -->
<input type="checkbox" id="hapus-barang" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <form action="{{ route('barang.hapus') }}" method="post">
            @csrf @method('delete')
            <h3 class="font-bold text-lg">
                Hapus {{ $barang->nama }} Dari Data Barang ?
            </h3>
            <input readonly type="hidden" value="{{ $barang->id }}" name="id" />
            <div class="modal-action">
                <label for="hapus-barang" class="btn btn-primary">Batal</label>
                <button type="submit" class="btn btn-error btn-outline">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
