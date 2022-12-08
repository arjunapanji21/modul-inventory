<?php

namespace App\Http\Controllers;

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
        ]);
    }

    public function barang_stok()
    {
        return view('barang.stok', [
            'title' => 'Data Stok Barang',
        ]);
    }

    public function barang_masuk()
    {
        return view('barang.masuk', [
            'title' => 'Data Barang Masuk',
        ]);
    }

    public function barang_keluar()
    {
        return view('barang.keluar', [
            'title' => 'Data Barang Keluar',
        ]);
    }

    public function laporan()
    {
        return view('laporan', [
            'title' => 'Laporan',
        ]);
    }
}
