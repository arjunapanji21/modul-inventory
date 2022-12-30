<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;
use Milon\Barcode\DNS2D;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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

    public function edit_barang($id)
    {
        return view('barang.edit', [
            'title' => 'Edit Data Barang',
            'barang' => Barang::find($id),
            'kategori' => Kategori::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function detail_barang_public($id)
    {
        if(Auth::check()){
            return view('qr', [
                'title' => 'Detail Barang',
                'barang' => Barang::find($id),
            ]);
        }else{
            return view('qr_guest', [
                'title' => 'Detail Barang',
                'barang' => Barang::find($id),
            ]);
        }
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

    public function laporan(Request $request)
    {
        $data = $request->all();
        if(count($data) > 0){
            $from = $data['from'];
            $to = $data['to'];
            $barang = Barang::orderBy('nama')->get();
            foreach($barang as $key=>$row){
                if($from != $to){
                    $stok_awal = BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->first() != null ? BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->first()->stok_awal : 0;
                    $barang[$key]->stok_awal = $stok_awal;

                    $masuk = BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                    $barang[$key]->masuk = $masuk;

                    $keluar = BarangKeluar::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                    $barang[$key]->keluar = $keluar;
                }else{
                    $stok_awal = BarangMasuk::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->first() != null ? BarangMasuk::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->first()->stok_awal : 0;
                    $barang[$key]->stok_awal = $stok_awal;

                    $masuk = BarangMasuk::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->sum('jumlah');
                    $barang[$key]->masuk = $masuk;

                    $keluar = BarangKeluar::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->sum('jumlah');
                    $barang[$key]->keluar = $keluar;
                }

                $stok_akhir = $stok_awal + $masuk - $keluar;
                $barang[$key]->stok_akhir = $stok_akhir;
            }
            $result = $barang;
            return view('laporan', [
                'title' => 'Laporan',
                'from' => $from,
                'to' => $to,
                'data' => $result,
            ]);
        }else {
            $from = date('Y-m-01');
            $to = date('Y-m-t');
            $barang = Barang::orderBy('nama')->get();
            foreach($barang as $key=>$row){
                $stok_awal = BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->first() != null ? BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->first()->stok_awal : 0;
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->keluar = $keluar;

                $stok_akhir = $stok_awal + $masuk - $keluar;
                $barang[$key]->stok_akhir = $stok_akhir;
            }
            $result = $barang;
            return view('laporan', [
                'title' => 'Laporan',
                'from' => $from,
                'to' => $to,
                'data' => $result,
            ]);
        }
    }

    public function laporan_print_pdf(Request $request)
    {
        $data = $request->all();
        $from = $data['from'];
        $to = $data['to'];
        $barang = Barang::orderBy('nama')->get();
        foreach($barang as $key=>$row){
            if($from != $to){
                $stok_awal = BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->first() != null ? BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->first()->stok_awal : 0;
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->keluar = $keluar;
            }else{
                $stok_awal = BarangMasuk::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->first() != null ? BarangMasuk::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->first()->stok_awal : 0;
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->keluar = $keluar;
            }

            $stok_akhir = $stok_awal + $masuk - $keluar;
            $barang[$key]->stok_akhir = $stok_akhir;
        }
        $result = $barang;
        return view('print.pdf', [
            'title' => 'Laporan',
            'from' => $from,
            'to' => $to,
            'data' => $result,
        ]);
    }

    public function laporan_export_pdf(Request $request)
    {
        $data = $request->all();
        $from = $data['from'];
        $to = $data['to'];
        $barang = Barang::orderBy('nama')->get();
        foreach($barang as $key=>$row){
            if($from != $to){
                $stok_awal = BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->first() != null ? BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->first()->stok_awal : 0;
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::whereBetween('created_at', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->keluar = $keluar;
            }else{
                $stok_awal = BarangMasuk::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->first() != null ? BarangMasuk::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->first()->stok_awal : 0;
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::where('created_at', 'like', $from.'%')->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->keluar = $keluar;
            }

            $stok_akhir = $stok_awal + $masuk - $keluar;
            $barang[$key]->stok_akhir = $stok_akhir;
        }
        $result = $barang;
        $pdf = Pdf::loadView('print.pdf', ['data' => $result, 'from' => $from, 'to' => $to])->setPaper('a4', 'portrait');;
        return $pdf->download('laporan_stok_barang_' . date('d-m-Y', strtotime($from)) .'_' . date('d-m-Y', strtotime($to)) .'.pdf');
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

    public function scan()
    {
        return view('scan', [
            'title' => 'Scan QR',
        ]);
    }
}
