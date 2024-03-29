<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function tambah_kategori(Request $request)
    {
        Kategori::create($request->all());
        return redirect(route('master.kategori'))->with('success', 'Berhasil Menambah Kategori Baru!');
    }

    public function update_kategori(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required',
        ]);
        $kategori = Kategori::find($id);
        $kategori->update($data);
        return redirect(route('master.kategori'))->with('success', 'Kategori Berhasil di Update!');
    }

    public function hapus_kategori(Request $request)
    {
        $kategori = Kategori::find($request['id']);
        if ($kategori->barang->count() > 0){
            return redirect(route('master.kategori'))->with('error', 'Tidak Bisa Menghapus Kategori Dengan Jumlah Barang Lebih Dari 0!');
        }
        $kategori->delete();
        return redirect(route('master.kategori'))->with('success', 'Kategori Berhasil di Hapus!');
    }

    public function tambah_user(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return redirect(route('master.users'))->with('success', 'Berhasil Menambah User Baru!');
    }

    public function update_user(Request $request, $id)
    {
        if($request['password'] != null){
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
        }else{
            $data = $request->except('password');
        }

        $user = User::find($id);
        $user->update($data);
        return redirect(route('master.users'))->with('success', 'User Berhasil di Update!');
    }

    public function hapus_user(Request $request)
    {
        $user = User::find($request['id']);
        $user->delete();
        return redirect(route('master.users'))->with('success', 'User Berhasil di Hapus!');
    }

    public function tambah_barang(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|unique:barangs',
            'nama' => 'required|unique:barangs',
            'kategori_id' => 'required',
            'gambar' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        try {
            if($request->hasFile('gambar')){
                $file = $request->file('gambar');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('img/produk/'), $filename);
                $data['gambar']= "img/produk/".$filename;
            }else{
                $data['gambar']= 'img/produk/sample.jpeg';
            }

            Barang::create($data);
            return redirect(route('barang.stok'))->with('success', 'Berhasil Menambah Data Barang Baru!');
        } catch (\Throwable $th) {
            // dd($th);
            // $message = "";
            // foreach($th->errorInfo as $err){
            //     $message = $err;
            // }
            return back()->with('error', 'Gagal Menambah Data Barang Baru!');
        }
    }

    public function update_barang(Request $request)
    {
        $data = $request->all();
        $barang = Barang::find($data['id']);
        try {
            if($request->hasFile('gambar')){
                $file = $request->file('gambar');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('img/produk/'), $filename);
                $data['gambar']= "img/produk/".$filename;
            }else{
                $data['gambar']= $barang->gambar;
            }

            $barang->update($data);
            return redirect(route('barang.stok'))->with('success', 'Berhasil Mengubah Data Barang Baru!');
        } catch (\Throwable $th) {
            // dd($th);
            // $message = "";
            // foreach($th->errorInfo as $err){
            //     $message = $err;
            // }
            return back()->with('error', 'Gagal Mengubah Data Barang Baru!');
        }
    }

    public function hapus_barang(Request $request)
    {
        $barang = Barang::with(['masuk', 'keluar'])->find($request['id']);
        foreach($barang->masuk as $row){
            $row->delete();
        }
        foreach($barang->keluar as $row){
            $row->delete();
        }
        $barang->delete();
        return redirect(route('barang.stok'))->with('success', 'Data Barang Berhasil Di Hapus!');
    }

    public function barang_masuk(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'jumlah' => 'required',
            'tgl_masuk' => 'required',
        ]);
        $data = $request->all();
        if($request->hasFile('foto_faktur')){
            $data['foto_faktur'] = base64_encode(file_get_contents($request->file('foto_faktur')->path()));
        }
        // dd($data);
        $barang = Barang::find($data['barang_id']);
        $data['stok_awal'] = $barang->stok;
        $data['stok_akhir'] = $data['stok_awal'] + $data['jumlah'];
        $data['user'] = auth()->user()->name;
        BarangMasuk::create($data);
        $barang->update([
            'stok' => $data['stok_akhir'],
        ]);
        return redirect(route('barang.masuk'))->with('success', 'Berhasil Menyimpan Data Barang Masuk!');
    }

    public function hapus_barang_masuk(Request $request)
    {
        $data = BarangMasuk::find($request['id']);
        $barang = Barang::find($data->barang_id);
        $barang->update([
            'stok' => (int)$barang->stok - (int)$data->jumlah,
        ]);
        $data->delete();
        return redirect(route('barang.masuk'))->with('success', 'Berhasil Menghapus Data Barang Masuk!');
    }

    public function hapus_barang_keluar(Request $request)
    {
        $data = BarangKeluar::find($request['id']);
        $barang = Barang::find($data->barang_id);
        $barang->update([
            'stok' => (int)$barang->stok + (int)$data->jumlah,
        ]);
        $data->delete();
        return redirect(route('barang.keluar'))->with('success', 'Berhasil Menghapus Data Barang Keluar!');
    }

    public function barang_keluar(Request $request)
    {
        $data = $request->validate([
            'barang_id' => 'required',
            'jumlah' => 'required',
            'tgl_keluar' => 'required',
        ]);
        $barang = Barang::find($data['barang_id']);
        $data['stok_awal'] = $barang->stok;
        if($data['jumlah'] > $data['stok_awal']){
            return back()->with('error', 'Jumlah barang keluar tidak boleh lebih besar dari stok!');
        }else{
            $data['stok_akhir'] = $data['stok_awal'] - $data['jumlah'];
            $data['user'] = auth()->user()->name;
            BarangKeluar::create($data);
            $barang->update([
                'stok' => $data['stok_akhir'],
            ]);
            return redirect(route('barang.keluar'))->with('success', 'Berhasil Menyimpan Data Barang Keluar!');
        }
    }
}
