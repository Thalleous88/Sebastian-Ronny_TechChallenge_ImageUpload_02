<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // function untuk menampilkan semua gambar di page index
    public function index()
    {
        // Mengambil semua data gambar dari tabel images
        $images = Image::all();

        // Mengirim data gambar ke view 'index'
        return view('index', compact('images'));
    }

    // function untuk menyimpan/store gambar yang diupload ke dalam database
    public function store(Request $request) 
    {
        // validasi input agar hanya menerima file gambar dengan format dan ukuran tertentu
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // menyimpan file ke folder 'storage/app/public/gallery'
        $path = $request->file('image')->store('gallery', 'public');

        // menyimpan nama file yang diupload ke database
        Image::create([
            'filename' => $path
        ]);

        // mengarahkan user ke halaman utama dengan pesan sukses apabila image telah berhasil diupload
        return redirect()->route('index')->with('success', 'Image uploaded successfully!');
    }

    // function untuk mengupdate gambar yang sudah ada
    public function update(Request $request, $id)
    {
        // validasi input gambar yang baru sama seperti di function store
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // mencari gambar berdasarkan id gambar tersebut, jika tidak ditemukan akan error 404
        $image = Image::findOrFail($id);

        // menghapus file lama dari storage
        Storage::disk('public')->delete($image->filename);

        // menyimpan file gambar baru
        $path = $request->file('image')->store('gallery', 'public');

        // mengupdate nama file di database
        $image->update([
            'filename' => $path
        ]);

        // mengarahkan user ke halaman utama dengan pesan sukses apabila image berhasil diupdate/diperbarui
        return redirect()->route('index')->with('success', 'Image updated successfully!');
    }

    // function untuk menghapus/delete gambar
    public function destroy($id)
    {
        // mencari gambar berdasarkan id gambar tersebut
        $image = Image::findOrFail($id);

        // menghapus file dari storage
        Storage::disk('public')->delete($image->filename);

        // menghapus record image tersebut dari database
        $image->delete();

        // mengarahkan user ke halaman utama dengan pesan sukses apabila image berhasil didelete/dihapus
        return redirect()->route('index')->with('success', 'Image deleted!');
    }
}
