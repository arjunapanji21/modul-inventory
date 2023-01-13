@extends('layouts.main') @section('content')
<div class="py-2 flex gap-2">
    <input
        id="search"
        type="text"
        placeholder="Search"
        class="input input-bordered w-full"
    />
    <label for="tambah-barang" class="btn btn-primary">Buat User Baru</label>
</div>
<input type="checkbox" id="tambah-barang" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <form action="{{ route('master.users.create') }}" method="post">
            @csrf
            <h3 class="font-bold text-lg">Buat User Baru</h3>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama User</span>
                </label>
                <input
                    required
                    name="name"
                    type="text"
                    placeholder="Nama User"
                    class="input input-bordered w-full"
                />
                <label class="label">
                    <span class="label-text-alt text-error"
                        >Field tidak boleh kosong</span
                    >
                </label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Role</span>
                </label>
                <select
                    required
                    name="role"
                    class="select select-bordered w-full"
                >
                    <option disabled selected>Pilih Role</option>
                    <option value="Staff">Karyawan Toko</option>
                    <option value="Admin">Admin Gudang</option>
                    <option value="Owner">Pemilik</option>
                </select>
                <label class="label">
                    <span class="label-text-alt text-error"
                        >Field tidak boleh kosong</span
                    >
                </label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input
                    required
                    name="email"
                    type="email"
                    placeholder="Email"
                    class="input input-bordered w-full"
                />
                <label class="label">
                    <span class="label-text-alt text-error"
                        >Field tidak boleh kosong</span
                    >
                </label>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input
                        required
                        name="password"
                        type="password"
                        placeholder="Password"
                        class="input input-bordered w-full"
                    />
                    <label class="label">
                        <span class="label-text-alt text-error"
                            >Field tidak boleh kosong</span
                        >
                    </label>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Password Confirmation</span>
                    </label>
                    <input
                        required
                        name="password_confirmation"
                        type="password"
                        placeholder="Password Confirmation"
                        class="input input-bordered w-full"
                    />
                    <label class="label">
                        <span class="label-text-alt text-error"
                            >Field tidak boleh kosong</span
                        >
                    </label>
                </div>
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
                    <th>Nama User</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th class="text-center">
                        <i class="fa-solid fa-ellipsis"></i>
                    </th>
                </tr>
            </thead>
            <tbody id="table-search">
                @if($users->count() > 0) @foreach($users as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                    <td>
                        @if($row->role == "Owner") Pemilik @elseif($row->role ==
                        "Admin") Admin Gudang @else Karyawan Toko @endif
                    </td>
                    <td>{{ $row->email }}</td>
                    <td class="text-center">
                        <label
                            class="btn btn-square btn-outline btn-sm"
                            for="edit-user-{{ $row->id }}"
                            ><i class="fa-solid fa-pen"></i
                        ></label>
                        <label
                            class="btn btn-square btn-outline btn-error btn-sm @if($row->id == auth()->user()->id) hidden @endif"
                            for="hapus-user-{{ $row->id }}"
                            ><i class="fa-solid fa-trash"></i
                        ></label>
                    </td>
                    <!-- Modal Edit -->
                    <input
                        type="checkbox"
                        id="edit-user-{{ $row->id }}"
                        class="modal-toggle"
                    />
                    <div class="modal">
                        <div class="modal-box">
                            <form
                                action="{{ route('master.users.update', $row->id) }}"
                                method="post"
                            >
                                @csrf @method('put')
                                <h3 class="font-bold text-lg">
                                    Edit Data User
                                </h3>
                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text"
                                            >Nama User</span
                                        >
                                    </label>
                                    <input
                                        required
                                        name="name"
                                        type="text"
                                        placeholder="Nama User"
                                        class="input input-bordered w-full"
                                        value="{{ $row->name }}"
                                    />
                                    <label class="label">
                                        <span class="label-text-alt text-error"
                                            >Field tidak boleh kosong</span
                                        >
                                    </label>
                                </div>
                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Role</span>
                                    </label>
                                    <select
                                        required
                                        name="role"
                                        class="select select-bordered w-full"
                                    >
                                        <option disabled>Pilih Role</option>
                                        @if($row->role == "Staff")
                                        <option selected value="Staff">
                                            Karyawan Toko
                                        </option>
                                        <option value="Admin">
                                            Admin Gudang
                                        </option>
                                        <option value="Owner">Pemilik</option>
                                        @elseif($row->role == "Admin")
                                        <option value="Staff">
                                            Karyawan Toko
                                        </option>
                                        <option selected value="Admin">
                                            Admin Gudang
                                        </option>
                                        <option value="Owner">Pemilik</option>
                                        @else
                                        <option value="Staff">
                                            Karyawan Toko
                                        </option>
                                        <option value="Admin">
                                            Admin Gudang
                                        </option>
                                        <option selected value="Owner">
                                            Pemilik
                                        </option>
                                        @endif
                                    </select>
                                    <label class="label">
                                        <span class="label-text-alt text-error"
                                            >Field tidak boleh kosong</span
                                        >
                                    </label>
                                </div>
                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Email</span>
                                    </label>
                                    <input
                                        required
                                        name="email"
                                        type="email"
                                        placeholder="Email"
                                        class="input input-bordered w-full"
                                        value="{{ $row->email }}"
                                    />
                                    <label class="label">
                                        <span class="label-text-alt text-error"
                                            >Field tidak boleh kosong</span
                                        >
                                    </label>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="form-control w-full">
                                        <label class="label">
                                            <span class="label-text"
                                                >Password</span
                                            >
                                        </label>
                                        <input
                                            name="password"
                                            type="password"
                                            placeholder="Password"
                                            class="input input-bordered w-full"
                                        />
                                        <label class="label">
                                            <span
                                                class="label-text-alt text-error"
                                                >Field tidak boleh kosong</span
                                            >
                                        </label>
                                    </div>
                                    <div class="form-control w-full">
                                        <label class="label">
                                            <span class="label-text"
                                                >Password Confirmation</span
                                            >
                                        </label>
                                        <input
                                            name="password_confirmation"
                                            type="password"
                                            placeholder="Password Confirmation"
                                            class="input input-bordered w-full"
                                        />
                                        <label class="label">
                                            <span
                                                class="label-text-alt text-error"
                                                >Field tidak boleh kosong</span
                                            >
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-action">
                                    <label
                                        for="edit-user-{{ $row->id }}"
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
                        id="hapus-user-{{ $row->id }}"
                        class="modal-toggle"
                    />
                    <div class="modal">
                        <div class="modal-box">
                            <form
                                action="{{ route('master.users.hapus') }}"
                                method="post"
                            >
                                @csrf @method('delete')
                                <h3 class="font-bold text-lg">
                                    Hapus {{ $row->name }} Dari Data User ?
                                </h3>
                                <input
                                    readonly
                                    type="hidden"
                                    value="{{ $row->id }}"
                                    name="id"
                                />
                                <div class="modal-action">
                                    <label
                                        for="hapus-user-{{ $row->id }}"
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
