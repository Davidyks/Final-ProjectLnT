<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Chipi Chapa</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/home.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav>
        <div class="left">
            <img src="{{ asset('asset/Logo Chipi Chapa.png')}}" alt="Logo chipi chapa">
        </div>
        <div class="right">
            <a href="/" style="font-weight:bold">Home</a>
            <a href="/keranjang">Keranjang</a>
            <a href="/login" class="login">Login</a>
        </div>
    </nav>

    <div class="image">
      <img src="{{ asset('asset/image1.jpg')}}" alt="">
    </div>
    <div class="product">
        <a href="/add-product">Add Product</a>
        <a href="/add-category">Add Category</a>
        
            @forelse ($categories as $c)
                <h1>{{ $c->Nama }} |</h1>
                <br>
                <div class="item">
                @forelse($products as $p)
                @if($c->id != $p->CategoryId)
                    @continue
                @endif
                <div class="card">
                    <img src="{{ asset('storage/'.$p->Photo) }}" alt="{{ $p->Photo }}">
                    <h2>Nama: {{ $p->Nama }}</h2>
                    <h2>Harga: Rp. {{ $p->Harga }}</h2>
                    <h2>Jumlah: {{ $p->Jumlah }}</h2>
                    <div class="tombol">
                            <button class="btn btn-info" style="margin-right: 20px">
                                <a href="/edit-product/{{ $p->id }}">Update</a>
                            </button>
                            <button class="btn btn-info" style="margin-right: 20px">
                                <a href="/keranjang1/{{ $p->id }}">Add</a>
                            </button>
                            <form action="/delete-product/{{ $p->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </div>
                </div>
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