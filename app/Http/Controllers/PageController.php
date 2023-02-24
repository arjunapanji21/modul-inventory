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
        $kategori = [];
        $barang_masuk = BarangMasuk::all();
        foreach ($barang_masuk as $row) {
            array_push($kategori, $row->barang->kategori->nama);
        }
        $kategori2 = [];
        $barang_keluar = BarangKeluar::all();
        foreach ($barang_keluar as $row) {
            array_push($kategori2, $row->barang->kategori->nama);
        }
        $barang_masuk = array_count_values($kategori);
        $barang_keluar = array_count_values($kategori2);
        $stat_masuk['kategori'] = [];
        $stat_masuk['jumlah'] = [];
        foreach ($barang_masuk as $key => $row) {
            array_push($stat_masuk['kategori'], $key);
            array_push($stat_masuk['jumlah'], $row);
        }
        // array_flip($stat_masuk['jumlah']);

        $stat_keluar['kategori'] = [];
        $stat_keluar['jumlah'] = [];
        foreach ($barang_keluar as $key => $row) {
            array_push($stat_keluar['kategori'], $key);
            array_push($stat_keluar['jumlah'], $row);
        }
        return view('dashboard', [
            'title' => 'Dashboard',
            'data_barang' => Barang::all()->count(),
            'data_masuk' => BarangMasuk::all()->count(),
            'data_keluar' => BarangKeluar::all()->count(),
            'stok_habis' => Barang::where('stok', '<', 12)->get(),
            'stat_masuk' => $stat_masuk,
            'stat_keluar' => $stat_keluar,
        ]);
    }

    public function detail_barang($id)
    {
        $barang = Barang::find($id);
        $barang->stok = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', date('Y-m-d')])->where('barang_id', $id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', date('Y-m-d')])->where('barang_id', $id)->sum('jumlah');
        return view('barang.detail', [
            'title' => 'Detail Barang',
            'barang' => $barang,
        ]);
    }

    public function detail_barang_print_qr($id)
    {
        $barang = Barang::find($id);
        $barang->stok = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', date('Y-m-d')])->where('barang_id', $id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', date('Y-m-d')])->where('barang_id', $id)->sum('jumlah');
        return view('print.qr-code', [
            'title' => 'Print QR Code ',
            'barang' => $barang,
        ]);
    }

    public function edit_barang($id)
    {
        $barang = Barang::find($id);
        $barang->stok = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', date('Y-m-d')])->where('barang_id', $id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', date('Y-m-d')])->where('barang_id', $id)->sum('jumlah');
        return view('barang.edit', [
            'title' => 'Edit Data Barang',
            'barang' => $barang,
            'kategori' => Kategori::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function detail_barang_public($id)
    {
        $barang = Barang::find($id);
        $barang->stok = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', date('Y-m-d')])->where('barang_id', $id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', date('Y-m-d')])->where('barang_id', $id)->sum('jumlah');
        if (Auth::check()) {
            return view('qr', [
                'title' => 'Detail Barang',
                'barang' => $barang,
            ]);
        } else {
            return view('qr_guest', [
                'title' => 'Detail Barang',
                'barang' => $barang,
            ]);
        }
    }

    public function barang_stok()
    {
        $barang = Barang::orderBy('nama', 'asc')->get();
        foreach ($barang as $key => $row) {
            $barang[$key]->stok = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', date('Y-m-d')])->where('barang_id', $row->id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', date('Y-m-d')])->where('barang_id', $row->id)->sum('jumlah');
        }
        return view('barang.stok', [
            'title' => 'Data Stok Barang',
            'kategori' => Kategori::orderBy('nama', 'asc')->get(),
            'barang' => $barang,
        ]);
    }

    public function barang_masuk()
    {
        return view('barang.masuk', [
            'title' => 'Data Barang Masuk',
            'barang_masuk' => BarangMasuk::orderBy('tgl_masuk', 'desc')->get(),
            'data_barang' => Barang::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function barang_keluar()
    {
        return view('barang.keluar', [
            'title' => 'Data Barang Keluar',
            'barang_keluar' => BarangKeluar::orderBy('tgl_keluar', 'desc')->get(),
            'data_barang' => Barang::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function laporan(Request $request)
    {
        $data = $request->all();
        if (count($data) > 0) {
            $from = $data['from'];
            $to = $data['to'];
            // dd(date('m', strtotime($to)) - 1);
            $barang = Barang::orderBy('nama')->get();
            foreach ($barang as $key => $row) {
                if ($from != $to) {
                    // $stok_awal = BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->first() != null ? BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->first()->stok_awal : 0;
                    // $stok_awal = BarangMasuk::where('barang_id', $row->id)->latest()->first() != null ? BarangMasuk::where('barang_id', $row->id)->latest()->first()->stok_awal : 0;

                    $stok_awal = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah');

                    $barang[$key]->stok_awal = $stok_awal;

                    $masuk = BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                    $barang[$key]->masuk = $masuk;

                    $keluar = BarangKeluar::whereBetween('tgl_keluar', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                    $barang[$key]->keluar = $keluar;
                } else {
                    // $stok_awal = BarangMasuk::where('tgl_masuk', 'like', $from . '%')->where('barang_id', $row->id)->first() != null ? BarangMasuk::where('tgl_masuk', 'like', $from . '%')->where('barang_id', $row->id)->first()->stok_awal : 0;
                    $stok_awal = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah');
                    $barang[$key]->stok_awal = $stok_awal;

                    $masuk = BarangMasuk::where('tgl_masuk', 'like', $from . '%')->where('barang_id', $row->id)->sum('jumlah');
                    $barang[$key]->masuk = $masuk;

                    $keluar = BarangKeluar::where('tgl_keluar', 'like', $from . '%')->where('barang_id', $row->id)->sum('jumlah');
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
        } else {
            $from = date('Y-m-01');
            $to = date('Y-m-t');
            $barang = Barang::orderBy('nama')->get();
            foreach ($barang as $key => $row) {
                // $stok_awal = BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->first() != null ? BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->first()->stok_awal : 0;
                $stok_awal = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::whereBetween('tgl_keluar', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
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
        foreach ($barang as $key => $row) {
            if ($from != $to) {
                // $stok_awal = BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->first() != null ? BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->first()->stok_awal : 0;
                $stok_awal = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::whereBetween('tgl_keluar', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->keluar = $keluar;
            } else {
                // $stok_awal = BarangMasuk::where('tgl_masuk', 'like', $from . '%')->where('barang_id', $row->id)->first() != null ? BarangMasuk::where('tgl_masuk', 'like', $from . '%')->where('barang_id', $row->id)->first()->stok_awal : 0;
                $stok_awal = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::where('tgl_masuk', 'like', $from . '%')->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::where('tgl_keluar', 'like', $from . '%')->where('barang_id', $row->id)->sum('jumlah');
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
        foreach ($barang as $key => $row) {
            if ($from != $to) {
                // $stok_awal = BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->first() != null ? BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->first()->stok_awal : 0;
                $stok_awal = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::whereBetween('tgl_masuk', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::whereBetween('tgl_keluar', [$from, $to])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->keluar = $keluar;
            } else {
                // $stok_awal = BarangMasuk::where('tgl_masuk', 'like', $from . '%')->where('barang_id', $row->id)->first() != null ? BarangMasuk::where('tgl_masuk', 'like', $from . '%')->where('barang_id', $row->id)->first()->stok_awal : 0;
                $stok_awal = BarangMasuk::whereBetween('tgl_masuk', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah') - BarangKeluar::whereBetween('tgl_keluar', ['2021-01-01', $from])->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->stok_awal = $stok_awal;

                $masuk = BarangMasuk::where('tgl_masuk', 'like', $from . '%')->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->masuk = $masuk;

                $keluar = BarangKeluar::where('tgl_keluar', 'like', $from . '%')->where('barang_id', $row->id)->sum('jumlah');
                $barang[$key]->keluar = $keluar;
            }

            $stok_akhir = $stok_awal + $masuk - $keluar;
            $barang[$key]->stok_akhir = $stok_akhir;
        }
        $result = $barang;
        $pdf = Pdf::loadView('print.pdf', ['data' => $result, 'from' => $from, 'to' => $to])->setPaper('a4', 'portrait');;
        return $pdf->download('laporan_stok_barang_' . date('d-m-Y', strtotime($from)) . '_' . date('d-m-Y', strtotime($to)) . '.pdf');
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
