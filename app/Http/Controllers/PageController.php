<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;
use Milon\Barcode\DNS2D;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function menu()
    {
        return view('menu', [
            'title' => 'Menu',
        ]);
    }

    public function dashboard()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'data_barang' => Barang::all()->count(),
            'data_masuk' => BarangMasuk::all()->count(),
            'data_keluar' => BarangKeluar::all()->count(),
            'stok_habis' => Barang::where('stok', '<', 12)->get(),
        ]);
    }

    public function detail_barang($id)
    {
        return view('barang.detail', [
            'title' => 'Detail Barang',
            'barang' => Barang::find($id),
        ]);
    }

    public function detail_barang_public($id)
    {
        return view('scan', [
            'title' => 'Detail Barang',
            'barang' => Barang::find($id),
        ]);
    }

    public function barang_stok()
    {
        return view('barang.stok', [
            'title' => 'Data Stok Barang',
            'kategori' => Kategori::orderBy('nama', 'asc')->get(),
            'barang' => Barang::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function barang_masuk()
    {
        return view('barang.masuk', [
            'title' => 'Data Barang Masuk',
            'barang_masuk' => BarangMasuk::orderBy('created_at', 'desc')->get(),
            'data_barang' => Barang::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function barang_keluar()
    {
        return view('barang.keluar', [
            'title' => 'Data Barang Keluar',
            'barang_masuk' => BarangKeluar::orderBy('created_at', 'desc')->get(),
            'data_barang' => Barang::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function laporan()
    {
        return view('laporan', [
            'title' => 'Laporan',
        ]);
    }

    public function master_kategori()
    {
        return view('master.kategori', [
            'title' => 'Kategori',
            'kategori' => Kategori::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function master_users()
    {
        return view('master.users', [
            'title' => 'Users',
            'users' => User::orderBy('name', 'asc')->get(),
        ]);
    }
}
