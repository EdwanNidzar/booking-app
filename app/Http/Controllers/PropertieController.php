<?php

namespace App\Http\Controllers;

use App\Models\Penginapan;
use App\Models\Propertie;
use App\Models\Aula;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PropertieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Propertie::with(['penginapan','aula'])->orderBy('id', 'desc')->paginate(5);
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penginapans = Penginapan::where('host_id', auth()->id())->get();
        $aulas = Aula::where('host_id', auth()->id())->get();
        return view('properties.create', compact('penginapans', 'aulas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // Debugging

        // Validasi
        $rules = [
            'jenis'       => 'required|in:penginapan,aula',
            'facilities'  => 'required',
            'max_guest'   => 'required|integer',
        ];

        if ($request->jenis === 'penginapan') {
            $rules['penginapan_id'] = 'required|exists:penginapans,id';
            $rules['type']          = 'required';
            $rules['beds']          = 'required|integer';
            $rules['bathrooms']     = 'required|integer';
        } elseif ($request->jenis === 'aula') {
            $rules['aula_id'] = 'required|exists:aulas,id';
        }

        $validatedData = $request->validate($rules);

        // Filter hanya data yang diperlukan
        $data = array_filter($validatedData, function ($value) {
            return $value !== null;
        });

        // Simpan ke database
        Propertie::create($data);

        return redirect()->route('properties.index')->with('success', 'Properti berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $propertie = Propertie::with('penginapan', 'aula')->findOrFail($id);
        return view('properties.show', compact('propertie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $propertie = Propertie::findOrFail($id);
        $penginapans = Penginapan::where('host_id', auth()->id())->get();
        $aulas = Aula::where('host_id', auth()->id())->get();
        return view('properties.edit', compact('propertie', 'penginapans', 'aulas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|in:penginapan,aula',
            'penginapan_id' => 'nullable|required_if:jenis,penginapan|exists:penginapans,id',
            'aula_id' => 'nullable|required_if:jenis,aula|exists:aulas,id',
            'type' => 'nullable|required_if:jenis,penginapan|in:kamar,villa,apartemen',
            'beds' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'facilities' => 'nullable|string',
            'max_guest' => 'required|integer|min:1',
        ]);

        $property = Propertie::findOrFail($id);
        $property->jenis = $request->jenis;
        $property->penginapan_id = $request->jenis === 'penginapan' ? $request->penginapan_id : null;
        $property->aula_id = $request->jenis === 'aula' ? $request->aula_id : null;
        $property->type = $request->jenis === 'penginapan' ? $request->type : null;
        $property->beds = $request->jenis === 'penginapan' ? $request->beds : null;
        $property->bathrooms = $request->jenis === 'penginapan' ? $request->bathrooms : null;
        $property->facilities = $request->facilities;
        $property->max_guest = $request->max_guest;
        $property->save();

        return redirect()->route('properties.index')->with('success', 'Properti berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Propertie::findOrFail($id)->delete();
        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }
    
    /**
     * report propertie
     */
    public function reportProperties()
    {
        $properties = Propertie::with(['penginapan','aula'])->orderBy('id', 'desc')->paginate(5);
        $pdf = PDF::loadView('properties.report', compact('properties'));
        return $pdf->stream('properties-report.pdf');
    }
}
