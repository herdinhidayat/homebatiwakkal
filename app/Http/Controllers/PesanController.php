<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;


class PesanController extends Controller
{
    public function index($id)
    {
        $jasa = Jasa::where('id', $id)->first();

        return view('pesan.index', compact('jasa'));
    }

    public function pesan(Request $request, $id)
    {
        $jasa = Jasa::where('id', $id)->first();
        $tanggal = Carbon::now();
        // validasi apakah melebihi stok
        if ($request->jumlah_pesan > $jasa->jumlahboking) {
            return redirect('pesan/' . $id);
        }

        // cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //simpan ke database pesanan
        if (empty($cek_pesanan)) {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
            $pesanan->save();
        }


        // simpan ke database pesanan detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // cek pesanan detail
        $cek_pesanan_detail = PesananDetail::where('jasa_id', $jasa->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if (empty($cek_pesanan_detail)) {
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->jasa_id = $jasa->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $jasa->harga * $request->jumlah_pesan;
            $pesanan_detail->save();
        } else {
            $pesanan_detail = PesananDetail::where('jasa_id', $jasa->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah + $request->jumlah_pesan;
            // harga sekarang
            $harga_pesanan_detail_baru = $jasa->harga * $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }
        // jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + $jasa->harga * $request->jumlah_pesan;
        $pesanan->update();

        Alert::success('Berhasil', 'Kami akan kerjakan!');
        return redirect('dashboard');
    }

    public function check_out()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        $pesanan_details = []; // default-nya array kosong

        if (!empty($pesanan)) {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        }
        return view('pesan.check_out', compact('pesanan', 'pesanan_details'));
    }

    public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        Alert::success('Pesanan Sukses Dihapus', 'Success');
        return redirect('check_out');
    }

    public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if (empty($user->alamat)) {
            Alert::error('Identitasi Harap dilengkapi', 'Error');
            return redirect('profilestatus');
        }
        if (empty($user->nohp)) {
            Alert::error('Identitasi Harap dilengkapi', 'Error');
            return redirect('profilestatus');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_details as $pesanan_detail) {
            $jasa = Jasa::where('id', $pesanan_detail->jasa_id)->first();
            $jasa->jumlahboking = $jasa->jumlahboking - $pesanan_detail->jumlah;
            $jasa->update();
        }

        alert::success('Pesanan Sukses Check Out', 'Success');
        return redirect('check_out');
    }
}
