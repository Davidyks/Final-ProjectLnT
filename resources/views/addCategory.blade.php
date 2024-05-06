<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="font-family: 'poppins'">
    <div style="border-radius: 20px; margin: 150px; background-color: aliceblue; padding: 40px">
        <h1>Add Category</h1>
        <hr>
        <form action="/add-category1" method="POST">
            @csrf
            <div class="mb-3">
                <label for="Nama" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="Nama" aria-describedby="emailHelp" name="Nama" value="{{ old('Nama') }}">
                @error('Nama')
                    <p style="color: red;">{{ $message }}</p>
                @enderror   
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>