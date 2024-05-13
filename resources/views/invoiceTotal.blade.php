<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="font-family: 'poppins'">
    <div style="border-radius: 20px; margin: 150px; background-color: aliceblue; padding: 40px">
        <h1>Invoice</h1>
        <hr>
            <form action="/status-done" method="POST">
            @csrf
            @method('patch')
            <div class="text1">
            <h2><b>Invoice Number</b>: <br>{{ $invoice->InvoiceNum }}</h2><br>
            <h2><b>Alamat Pengiriman</b>: <br>{{ $invoice->Alamat }}</h2><br>
            <h2><b>Kode Pos</b>: <br>{{ $invoice->KodePos }}</h2><br>
            </div>
            <hr>
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
                <!-- <h2>Category: {{ $p->category->Nama }} </h2> -->
                <h2>Nama: {{ $p->Nama }}</h2>
                <h2>Harga: Rp. {{ $p->Harga }}</h2>
                <h2>Jumlah: {{ $keranjang[$key]->Jumlah }}</h2>
                <h2>Subtotal: {{ $keranjang[$key]->Subtotal }}</h2>
            </div>
            @endif
            @empty
                <p>{{ "No Products Added." }}</p>
            @endforelse
        </div>
        @empty
        <p>{{ "No Categories Added." }}</p>
        @endforelse
        <hr>
        <h2 style="font-size: 24px; color: rgb(33, 192, 240)">Total: Rp. {{ $total }}</h2>
        <hr>
        <img src="{{ asset('asset/KodeQR.jpg') }}" alt="QR"><br><br>
        <button type="submit" class="btn btn-primary">Complete Payment</button>
    </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>