<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Gallery</title>

    <!-- import bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5"> 

    <h2 class="text-center">Image Gallery</h2> 

    <!-- Menampilkan pesan sukses jika session memiliki 'success' -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Form untuk mengupload gambar baru, ketika disubmit akan diarahkan ke route store, multipart/form-data karena di sini kita mengupload image  -->
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" class="my-4">
        @csrf <!-- untuk security/keamanan -->
        <div class="input-group">
            <!-- Input untuk memilih file gambar -->
            <input type="file" name="image" class="form-control" required>
            <!-- Tombol untuk submit form -->
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>

    <!-- Menampilkan daftar/gallery gambar yang telah diupload -->
    <div class="row">
        @foreach($images as $image) <!-- Loop melalui semua gambar yang ada di database -->
            <div class="col-md-4 mb-4"> 
                <div class="card shadow-sm"> 
                    <!-- Menampilkan gambar -->
                    <img src="{{ asset('storage/' . $image->filename) }}" class="card-img-top img-fluid" alt="Image">

                    <div class="card-body text-center"> <!-- Bagian bawah kartu -->

                        <!-- Form untuk menghapus gambar -->
                        <form action="{{ route('delete', $image->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE') <!-- Method DELETE untuk delete data bawaan dari laravel untuk override method POST milik html -->
                            <button class="btn btn-danger btn-sm">Delete</button> <!-- Tombol hapus -->
                        </form>

                        <!-- Form untuk memperbarui/mengupdate gambar -->
                        <form action="{{ route('update', $image->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                            @csrf 
                            @method('PUT') <!-- Method PUT untuk update data bawaan dari laravel untuk overried method POST milik html -->
                            <!-- Input file baru untuk update gambar -->
                            <input type="file" name="image" class="form-control-file d-inline" style="width: 70%;" required>
                            <!-- Tombol untuk submit update -->
                            <button class="btn btn-warning btn-sm">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
