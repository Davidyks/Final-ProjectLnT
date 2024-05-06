<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Chipi Chapa</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/navbar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/keranjang.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav>
        <div class="left">
            <img src="{{ asset('asset/Logo Chipi Chapa.png')}}" alt="Logo chipi chapa">
        </div>
        <div class="right">
            <a href="/">Home</a>
            <a href="/keranjang" style="font-weight:bold">Keranjang</a>
            <a href="/login" class="login">Login</a>
        </div>
    </nav>
    
    <div class="product">
        @if($checkout === false)
            <div class="tombol">
                <button class="btn btn-info" style="margin-right: 20px">
                    <a href="/invoice">Checkout All</a>
                </button>
            </div>
        @endif
        <br>
        <div class="item">
        @forelse($products as $key => $p)
        @if($keranjang[$key]->Status != 'done')
        <div class="card">
            <img src="{{ asset('storage/'.$p->Photo) }}" alt="{{ $p->Photo }}">
            <h2>Nama: {{ $p->Nama }}</h2>
            <h2>Harga: Rp. {{ $p->Harga }}</h2>
            <h2>Status : {{ $keranjang[$key]->Status }}</h2>
        </div>
        @endif
        @empty
            <p>{{ "No Products Added." }}</p>
        @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>