<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="font-family: 'poppins'">
    <div style="border-radius: 20px; margin: 150px; background-color: aliceblue; padding: 40px">
        <h1>Update Product</h1>
        <hr>
        <form action="/update-product/{{ $prod->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            @forelse($categories as $c)
            <input type="radio" id="{{ $c->id }}" name="CategoryId" value="{{ $c->id }}">
            <label for="{{ $c->id }}">{{ $c->Nama }}</label><br>
            @empty
                <p>No category added.</p>
            @endforelse
            <br>
            <div class="mb-3">
                <label for="Nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="Nama" aria-describedby="emailHelp" name="Nama" value="{{ $prod->Nama }}">
                @error('Nama')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="Harga" aria-describedby="emailHelp" name="Harga" value="{{ $prod->Harga }}">
                @error('Harga')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="Jumlah" aria-describedby="emailHelp" name="Jumlah" value="{{ $prod->Jumlah }}">
                @error('Jumlah')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="Photo" aria-describedby="emailHelp" name="Photo">
                @error('Photo')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>