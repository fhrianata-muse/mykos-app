<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KosController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $kosSaya = $user->kos()->withCount('bookings')->latest()->get();
        $bookingMasuk = \App\Models\Booking::whereIn('kos_id', $user->kos()->pluck('id'))
            ->with(['user', 'kos'])
            ->latest()
            ->take(5)
            ->get();
        $menunggu = \App\Models\Booking::whereIn('kos_id', $user->kos()->pluck('id'))
            ->where('status', 'menunggu')
            ->count();

        return view('pemilik.dashboard', compact('kosSaya', 'bookingMasuk', 'menunggu'));
    }

    public function index()
    {
        $kos = auth()->user()->kos()->latest()->get();

        return view('pemilik.kos.index', compact('kos'));
    }

    public function create()
    {
        return view('pemilik.kos.create', ['kos' => new Kos()]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        auth()->user()->kos()->create($data);

        return redirect()->route('pemilik.kos.index')
            ->with('success', 'Kos berhasil ditambahkan dan langsung tampil di katalog.');
    }

    public function edit(Kos $kos)
    {
        $this->pastikanMilikSaya($kos);

        return view('pemilik.kos.edit', compact('kos'));
    }

    public function update(Request $request, Kos $kos)
    {
        $this->pastikanMilikSaya($kos);
        $kos->update($this->validasi($request));

        return redirect()->route('pemilik.kos.index')
            ->with('success', 'Data kos berhasil diperbarui.');
    }

    public function destroy(Kos $kos)
    {
        $this->pastikanMilikSaya($kos);
        $kos->delete();

        return redirect()->route('pemilik.kos.index')
            ->with('success', 'Kos berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'max:100'],
            'area' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'tipe' => ['required', Rule::in(['putra', 'putri', 'campur'])],
            'harga' => ['required', 'integer', 'min:10000'],
            'kamar_tersedia' => ['required', 'integer', 'min:0', 'max:1000'],
            'fasilitas' => ['required', 'string', 'max:1000'],
            'deskripsi' => ['nullable', 'string'],
            'aturan' => ['nullable', 'string'],
            'foto_url' => ['nullable', 'url', 'max:500'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);
    }

    private function pastikanMilikSaya(Kos $kos): void
    {
        abort_unless($kos->user_id === auth()->id(), 403, 'Ini bukan kos milikmu.');
    }
}
