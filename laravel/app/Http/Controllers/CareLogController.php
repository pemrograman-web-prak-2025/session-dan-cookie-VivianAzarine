<?php

namespace App\Http\Controllers;

use App\Models\CareLog;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CareLogController extends Controller
{
    // READ: Tampilkan semua log perawatan untuk hewan tertentu
    public function index(Pet $pet)
    {
        // Pastikan user hanya bisa lihat log dari hewan miliknya
        if ($pet->user_id !== Auth::id()) {
            abort(403);
        }

        $careLogs = $pet->careLogs()->latest()->get();
        return view('care-logs.index', compact('pet', 'careLogs'));
    }

    // CREATE: Tampilkan form tambah log perawatan
    public function create(Pet $pet)
    {
        // Pastikan user hanya bisa tambah log untuk hewan miliknya
        if ($pet->user_id !== Auth::id()) {
            abort(403);
        }

        return view('care-logs.create', compact('pet'));
    }

    // CREATE: Simpan log perawatan baru
    public function store(Request $request, Pet $pet)
    {
        // Pastikan user hanya bisa tambah log untuk hewan miliknya
        if ($pet->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'activity_type' => 'required|string|max:255',
            'activity_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $validated['pet_id'] = $pet->id;

        CareLog::create($validated);

        return redirect()->route('pets.show', $pet)->with('success', 'Log perawatan berhasil ditambahkan!');
    }

    // UPDATE: Tampilkan form edit log perawatan
    public function edit(Pet $pet, CareLog $careLog)
    {
        // Pastikan user hanya bisa edit log dari hewan miliknya
        if ($pet->user_id !== Auth::id() || $careLog->pet_id !== $pet->id) {
            abort(403);
        }

        return view('care-logs.edit', compact('pet', 'careLog'));
    }

    // UPDATE: Simpan perubahan log perawatan
    public function update(Request $request, Pet $pet, CareLog $careLog)
    {
        // Pastikan user hanya bisa update log dari hewan miliknya
        if ($pet->user_id !== Auth::id() || $careLog->pet_id !== $pet->id) {
            abort(403);
        }

        $validated = $request->validate([
            'activity_type' => 'required|string|max:255',
            'activity_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $careLog->update($validated);

        return redirect()->route('pets.show', $pet)->with('success', 'Log perawatan berhasil diperbarui!');
    }

    // DELETE: Hapus log perawatan
    public function destroy(Pet $pet, CareLog $careLog)
    {
        // Pastikan user hanya bisa hapus log dari hewan miliknya
        if ($pet->user_id !== Auth::id() || $careLog->pet_id !== $pet->id) {
            abort(403);
        }

        $careLog->delete();

        return redirect()->route('pets.show', $pet)->with('success', 'Log perawatan berhasil dihapus!');
    }
}