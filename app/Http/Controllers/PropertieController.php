<?php

namespace App\Http\Controllers;

use App\Models\Penginapan;
use App\Models\Propertie;
use Illuminate\Http\Request;

class PropertieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Propertie::with('penginapan')->orderBy('id', 'desc')->paginate(5);
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penginapans = Penginapan::where('host_id', auth()->id())->get();
        return view('properties.create', compact('penginapans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penginapan_id' => 'required',
            'type' => 'required',
            'beds' => 'required',
            'bathrooms' => 'required',
            'facilities' => 'required',
            'max_guest' => 'required',
        ]);

        Propertie::create($request->all());
        return redirect()->route('properties.index')->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $propertie = Propertie::with('penginapan')->findOrFail($id);
        return view('properties.show', compact('propertie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $propertie = Propertie::findOrFail($id);
        $penginapans = Penginapan::where('host_id', auth()->id())->get();
        return view('properties.edit', compact('propertie', 'penginapans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'penginapan_id' => 'required',
            'type' => 'required',
            'beds' => 'required',
            'bathrooms' => 'required',
            'facilities' => 'required',
            'max_guest' => 'required',
        ]);

        Propertie::findOrFail($id)->update($request->all());
        return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Propertie::findOrFail($id)->delete();
        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }
}
