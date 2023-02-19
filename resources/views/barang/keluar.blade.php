@extends('layouts.main') @section('content')
<div class="py-2 flex gap-2">
    <input
        id="search"
        type="text"
        placeholder="Search"
        class="input input-bordered w-full"
    />
    <label for="tambah-barang" class="btn btn-primary"
        >Input Barang Keluar</label
    >
</div>
<input type="checkbox" id="tambah-barang" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <form action="{{ route('barang.keluar.create') }}" method="post">
            @csrf
            <h3 class="font-bold text-lg">Form Input Barang Keluar</h3>
            <div class="form-control w-1/2">
                <label class="label">
                    <span class="label-text">Tgl. Keluar</span>
                </label>
                <div class="input-group">
                <span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-calendar-event-fill"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"
                            />
                        </svg>
                    </span>
                <input
                    name="tgl_keluar"
                    type="date"
                    class="input input-bordered w-full"
                    value="{{ date('Y-m-d') }}"
                />
            </div>
            <label class="label">
                <span class="label-text-alt text-error"
                    >Field tidak boleh kosong</span
                >
            </label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Barang</span>
                </label>
                <select
                    name="barang_id"
                    class="chosen-single select select-bordered w-full"
                >
                    <option disabled selected>Pilih Barang</option>
                    @foreach($data_barang as $row)
                    <option value="{{ $row->id }}">
                        {{ $row->kode . ' - ' . $row->nama }}
                    </option>
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
                    <span class="label-text">Jumlah</span>
                </label>
                <input
                    name="jumlah"
                    type="number"
                    placeholder="Jumlah Barang Masuk"
                    class="input input-bordered w-full"
                />
                <label class="label">
                    <span class="label-text-alt text-error"
                        >Field tidak boleh kosong</span
                    >
                </label>
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
                    <th>Tgl. Keluar</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    {{-- <th class="text-center">Stok Awal</th> --}}
                    <th class="text-center">Jumlah Keluar</th>
                    {{-- <th class="text-center">Stok Akhir</th> --}}
                    <th class="text-center">User</th>
                    <th class="text-center">Hapus</th>
                </tr>
            </thead>
            <tbody id="table-search">
                @if($barang_keluar->count() > 0) @foreach ($barang_keluar as $row)
                <tr>
                    <th>BK-{{ $row->id }}</th>
                    <td>{{ date('d/m/Y', strtotime($row->tgl_keluar)) }}</td>
                    <td>{{ $row->barang->kode }}</td>
                    <td>{{ $row->barang->nama }}</td>
                    {{-- <td class="text-center">{{ $row->stok_awal }}</td> --}}
                    <td class="text-center">{{ $row->jumlah }}</td>
                    {{-- <td class="text-center">{{ $row->stok_akhir }}</td> --}}
                    <td class="text-center">{{ $row->user }}</td>
                    <td class="text-center">
                        <label
                            for="hapus-data-{{ $row->id }}"
                            class="btn btn-error btn-outline btn-sm"
                            ><i class="fa-solid fa-trash"></i
                        ></label>
                    </td>
                    <!-- Modal Hapus -->
                    <input
                        type="checkbox"
                        id="hapus-data-{{ $row->id }}"
                        class="modal-toggle"
                    />
                    <div class="modal">
                        <div class="modal-box">
                            <form
                                action="{{ route('barang.keluar.hapus') }}"
                                method="post"
                            >
                                @csrf @method('delete')
                                <h3 class="font-bold text-lg">
                                    Hapus BK-{{ $row->id }} Dari Data Barang
                                    Keluar ?
                                </h3>
                                <input
                                    readonly
                                    type="hidden"
                                    value="{{ $row->id }}"
                                    name="id"
                                />
                                <div class="modal-action">
                                    <label
                                        for="hapus-data-{{ $row->id }}"
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
                    <td colspan="8" class="text-center">Tidak Ada Data</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
