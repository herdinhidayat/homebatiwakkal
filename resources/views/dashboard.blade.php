<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-4">
                <img src="{{ url('images/homebatiwakkal.png') }}" class="rounded mx-auto d-block" width="700"
                    alt="">
            </div>
            @foreach ($jasas as $jasa)
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ url('uploads') }}/{{ $jasa->fotojasa }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $jasa->nama_jasa }}</h5>
                            <p class="card-text mb-4">
                                <strong>Harga. </strong>Rp. {{ number_format($jasa->harga) }}<br>
                                <strong>Status: </strong>{{ $jasa->status }}
                                <hr>
                                <br>
                                <strong>Keterangan :</strong> <br>
                                {{ $jasa->keterangan }}
                            </p>
                            <a href="#" class="btn btn-primary mt-4"><i class="fa fa-shopping-cart"></i> Pesan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
