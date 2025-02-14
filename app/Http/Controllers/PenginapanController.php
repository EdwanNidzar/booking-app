<?php

namespace App\Http\Controllers;

use App\Models\Penginapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenginapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penginapans = Penginapan::with('host')->orderBy('id', 'desc')->paginate(5);
        return view('penginapan.index', compact('penginapans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penginapan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penginapan' => 'required',
            'location' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:5120',
            'price' => 'required',
            'status' => 'required',
        ]);

        // Simpan foto di public/penginapan
        $photoPath = $request->file('photo')->store('penginapan', 'public');

        Penginapan::create([
            'host_id' => auth()->id(),
            'nama_penginapan' => $request->nama_penginapan,
            'location' => $request->location,
            'photo' => $photoPath, // Simpan path-nya
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penginapan $penginapan)
    {
        return view('penginapan.show', compact('penginapan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penginapan $penginapan)
    {
        return view('penginapan.edit', compact('penginapan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penginapan $penginapan)
    {
        $request->validate([
            'nama_penginapan' => 'required',
            'location' => 'required',
            'photo' => 'image|mimes:jpg,png,jpeg|max:5120',
            'price' => 'required',
            'status' => 'required',
        ]);

        // Jika user mengunggah foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            Storage::delete('public/' . $penginapan->photo);

            // Simpan foto baru
            $photoPath = $request->file('photo')->store('penginapan', 'public');
        } else {
            $photoPath = $penginapan->photo;
        }

        $penginapan->update([
            'nama_penginapan' => $request->nama_penginapan,
            'location' => $request->location,
            'photo' => $photoPath,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penginapan $penginapan)
    {
        // Hapus foto
        Storage::delete('public/' . $penginapan->photo);

        $penginapan->delete();
        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil dihapus');
    }
}
