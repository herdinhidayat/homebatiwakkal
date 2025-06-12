<x-app-layout>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('history.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('history.index') }}">Riwayat Pemesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2><i class="fa fa-shopping-cart"></i>Detail Pemesanan</h2>
                        @if (!empty($pesanan))

                            <p align="right">Tanggal Pesan : {{ $pesanan->tanggal }}</p>
                            <p></p>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($pesanan_details as $pesanan_detail)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $pesanan_detail->jasa->nama_jasa }}</td>
                                            <td>{{ $pesanan_detail->jumlah }} Jasa
                                                {{ $pesanan_detail->jasa->nama_jasa }}
                                            </td>
                                            <td align="left">Rp. {{ number_format($pesanan_detail->jasa->harga) }}
                                            </td>
                                            <td align="left">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" align="right"><strong>Total Harga :</strong></td>
                                        <td><Strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</Strong></td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
