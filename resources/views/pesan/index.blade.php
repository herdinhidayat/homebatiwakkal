<x-app-layout>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('dashboard') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $jasa->nama_jasa }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ url('uploads') }}/{{ $jasa->fotojasa }}" class="rounded mx-auto d-block"
                                    width="100%" alt="">
                            </div>
                            <div class="col-md-6 mt-5">
                                <h3>{{ $jasa->nama_jasa }}</h3>
                                <table class="table table-bordered mt-5">
                                    <tbody>
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($jasa->harga) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td>{{ $jasa->status }}</td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:</td>
                                            <td>{{ $jasa->keterangan }}</td>
                                        </tr>
                                        <form action="" method="post">
                                            <tr>
                                                <td>Jumlah Pesan <br>
                                                    <h4>(Contoh berapa ac/sofa/kendaraan yang dicuci jika 1 ditulis 1)
                                                    </h4>
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="jumlah_pesan" class="form-control"
                                                        required="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
