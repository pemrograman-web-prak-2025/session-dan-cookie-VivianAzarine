<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    // READ: Tampilkan semua hewan milik user yang login
    public function index()
    {
        $pets = Auth::user()->pets()->latest()->get();
        return view('pets.index', compact('pets'));
    }

    // CREATE: Tampilkan form tambah hewan
    public function create()
    {
        return view('pets.create');
    }

    // CREATE: Simpan hewan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string'
        ]);

        $validated['user_id'] = Auth::id();

        // Upload foto jika ada
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('pets', 'public');
        }

        Pet::create($validated);

        return redirect()->route('pets.index')->with('success', 'Hewan peliharaan berhasil ditambahkan!');
    }

    // READ: Tampilkan detail hewan
    public function show(Pet $pet)
    {
        // Pastikan user hanya bisa lihat hewan miliknya sendiri
        if ($pet->user_id !== Auth::id()) {
            abort(403);
        }

        $pet->load('careLogs');
        return view('pets.show', compact('pet'));
    }

    // UPDATE: Tampilkan form edit hewan
    public function edit(Pet $pet)
    {
        // Pastikan user hanya bisa edit hewan miliknya sendiri
        if ($pet->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pets.edit', compact('pet'));
    }

    // UPDATE: Simpan perubahan hewan
    public function update(Request $request, Pet $pet)
    {
        // Pastikan user hanya bisa update hewan miliknya sendiri
        if ($pet->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string'
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($pet->photo) {
                Storage::disk('public')->delete($pet->photo);
            }
            $validated['photo'] = $request->file('photo')->store('pets', 'public');
        }

        $pet->update($validated);

        return redirect()->route('pets.index')->with('success', 'Data hewan berhasil diperbarui!');
    }

    // DELETE: Hapus hewan
    public function destroy(Pet $pet)
    {
        // Pastikan user hanya bisa hapus hewan miliknya sendiri
        if ($pet->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus foto jika ada
        if ($pet->photo) {
            Storage::disk('public')->delete($pet->photo);
        }

        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Hewan peliharaan berhasil dihapus!');
    }
}