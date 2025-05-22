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
                        <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2><i class="fa fa-shopping-cart"></i> Check Out</h2>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($pesanan_details as $pesanan_detail)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pesanan_detail->jasa->nama_jasa }}</td>
                                        <td>{{ $pesanan_detail->jumlah }} Jasa {{ $pesanan_detail->jasa->nama_jasa }}
                                        </td>
                                        <td align="left">Rp. {{ number_format($pesanan_detail->jasa->harga) }}</td>
                                        <td align="left">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>
                                        <td>
                                            <form action="{{ url('check-out') }}/{{ $pesanan_detail->id }}"
                                                method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right"><strong>Total Harga :</strong></td>
                                    <td><Strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</Strong></td>
                                    <td>
                                        <a href="{{ url('konfirmasi-check-out') }}" title=""
                                            class="btn btn-success">
                                            <i class="fa fa-shopping-cart"></i> Check Out
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
