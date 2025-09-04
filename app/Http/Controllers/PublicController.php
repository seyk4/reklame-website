<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Booking;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function map()
    {
        // Ambil semua proyek yang memiliki data latitude dan longitude
        $locations = Project::whereNotNull('latitude')->whereNotNull('longitude')->get();

        // Kirim data lokasi ke sebuah view baru
        return view('public.map', ['locations' => $locations]);
    }
    
    public function show(Project $project)
    {
        // Laravel akan otomatis mencari data Project berdasarkan ID di URL
        // dan menyimpannya di variabel $project.

        return view('public.show', ['project' => $project]);
    }

    public function storeBooking(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'nama_peminat' => 'required|string|max:255',
            'email_peminat' => 'required|email|max:255',
            'telepon_peminat' => 'required|string|max:20',
            'pesan' => 'nullable|string',
        ]);

        // 2. Buat record baru di tabel bookings
        Booking::create($validatedData);

        // 3. Kembalikan pengguna ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Pengajuan Anda telah terkirim! Tim kami akan segera menghubungi Anda.');
    }
}
