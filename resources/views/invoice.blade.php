<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/keranjang.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="font-family: 'poppins'">
    <div style="border-radius: 20px; margin: 150px; background-color: aliceblue; padding: 40px">
        <h1>Invoice</h1>
        <hr>
            <form id="invoice-form" action="/invoice1" method="POST">
            @csrf
            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="Alamat" aria-describedby="emailHelp" name="Alamat" value="{{ old('Alamat') }}">
                @error('Alamat')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="KodePos" class="form-label">Kode Pos</label>
                <input type="number" class="form-control" id="KodePos" aria-describedby="emailHelp" name="KodePos" value="{{ old('KodePos') }}">
                @error('KodePos')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- <button type="submit" id="submit-all-btn" class="btn btn-primary">Next</button> -->
        <div class="item">
            @forelse($products as $key => $p)
            @if($keranjang[$key]->Status != 'done')
            <div class="card">
                <img src="{{ asset('storage/'.$p->Photo) }}" alt="{{ $p->Photo }}">
                <h2>Nama: {{ $p->Nama }}</h2>
                <h2>Harga: Rp. {{ $p->Harga }}</h2>
                <div class="mb-3">
                <form action="/update-jumlah/{{ $keranjang[$key]->id }}" method="POST">
                @csrf
                @method('patch')
                <label for="Jumlah" class="form-label"><h2>Jumlah</h2></label>
                <input type="number" class="form-control" id="Jumlah" aria-describedby="emailHelp" name="Jumlah" value="{{ old('Jumlah') }}">
                @error('Jumlah')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
            @endif
            @empty
                <p>{{ "No Products Added." }}</p>
            @endforelse
        </div>
        <!-- <button type="submit" id="submit-all-btn" class="btn btn-primary">Next</button> -->
    </div>
    
    <!-- <script>    
    // console.log("click");
    document.getElementById('submit-all-btn').addEventListener('click', function() {
        event.preventDefault();

        var alamatValue = document.getElementById('Alamat').value.trim();
        var kodePosValue = document.getElementById('KodePos').value.trim();

        var jumlahInputs = document.querySelectorAll('input[name="Jumlah"]');
        var jumlahFill = true;

        for (var i = 0; i < jumlahInputs.length; i++) {
            if (jumlahInputs[i].value.trim() == 0) {
                // alert('Please enter a value.');
                jumlahFill = false;
                break;
            }
        }
        // console.log("p");
        if (alamatValue.length < 10 || kodePosValue.length != 5 || jumlahFill == false){
            // alert('Please fill in the Alamat and Kode Pos fields.');
            return;
        }
        
        var updateForms = document.querySelectorAll('form[action^="/update-jumlah/"]');
        updateForms.forEach(function(form) {
            form.submit();
        });

        document.getElementById('invoice-form').submit();
        
    });
    </script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
</body>
</html>