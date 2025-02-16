<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::with('host')->orderBy('id', 'desc')->paginate(5);
        return view('aula.index', compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aula.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_aula' => 'required',
            'location' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:5120',
            'price' => 'required',
            'status' => 'required',
        ]);

        // Simpan foto di public/aula
        $photoPath = $request->file('photo')->store('aula', 'public');

        Aula::create([
            'host_id' => auth()->id(),
            'nama_aula' => $request->nama_aula,
            'location' => $request->location,
            'photo' => $photoPath, // Simpan path-nya
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('aula.index')->with('success', 'Aula berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aula $aula)
    {
        return view('aula.show', compact('aula'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aula $aula)
    {
        return view('aula.edit', compact('aula'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aula $aula)
    {
        $request->validate([
            'nama_aula' => 'required',
            'location' => 'required',
            'photo' => 'image|mimes:jpg,png,jpeg|max:5120',
            'price' => 'required',
            'status' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($aula->photo);
            $photoPath = $request->file('photo')->store('aula', 'public');
        } else {
            $photoPath = $aula->photo;
        }

        $aula->update([
            'nama_aula' => $request->nama_aula,
            'location' => $request->location,
            'photo' => $photoPath,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('aula.index')->with('success', 'Aula berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aula $aula)
    {
        $aula->delete();
        Storage::disk('public')->delete($aula->photo);
        return redirect()->route('aula.index')->with('success', 'Aula berhasil dihapus');
    }
}
