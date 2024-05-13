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
            @if(!Auth::user())
            <a href="/login" class="login">Login</a>
            @endif
            @if(Auth::user())
            <form method="POST" action="logout">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="login">Logout</a>
            </form>
            @endif
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
        @if($checkout === true)
        <div>
            <!-- <h2 style="text-align:center; font:poppins; color:rgb(33,192,240); margin-top:200px">Empty Cart !</h2> -->
            <img src="{{ asset( 'asset/keranjang.png') }}" alt="keranjang" style="display: block; margin-left: auto; margin-right: auto; margin-top:50px; margin-bottom: 100px">
        </div>
        @endif
        <br>
        @forelse ($categories as $c)
            <!-- @forelse($products as $key => $p)
            @if($c->id != $p->CategoryId || $keranjang[$key]->Status === 'done')
                @continue
            @endif            
            <h1 style="font-size: 24px; color: rgb(33, 192, 240)">{{ $c->Nama }} |</h1>
            <br>
            @empty
                <p>{{ "No Products Added." }}</p>
            @endforelse -->
            @if($categoryStat[$c->id] === false)
                    @continue
            @endif     
            <h1 style="font-size: 24px; color: rgb(33, 192, 240)">{{ $c->Nama }} |</h1>
            <br>   
        <div class="item">
        @forelse($products as $key => $p)
        @if($c->id != $p->CategoryId)
                @continue
        @endif
        @if($keranjang[$key]->Status != 'done' && $keranjang[$key]->UserId == Auth::user()->id)
        <div class="card">
            <img src="{{ asset('storage/'.$p->Photo) }}" alt="{{ $p->Photo }}">
            <h2>Nama: {{ $p->Nama }}</h2>
            <h2>Harga: Rp. {{ $p->Harga }}</h2>
            <h2>Status : {{ $keranjang[$key]->Status }}</h2>
            <form action="/update-jumlah/{{ $keranjang[$key]->id }}" method="POST">
                @csrf
                @method('patch')
                <label for="Jumlah" class="form-label"><h2>Jumlah</h2></label>
                <input type="number" class="form-control" id="Jumlah" aria-describedby="emailHelp" name="Jumlah" value="{{ $keranjang[$key]->Jumlah }}">
                @error('Jumlah')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                <div class="tombol1">
                <button type="submit" class="btn btn-primary">Change</button>
                </form>
                <form action="/delete-keranjang/{{ $keranjang[$key]->id }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit">
                        Delete
                    </button>
                </form>
                </div>
        </div>
        @endif
        @empty
            <p>{{ "No Products Added." }}</p>
        @endforelse
        </div>
        @empty
        <p>{{ "No Categories Added." }}</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>