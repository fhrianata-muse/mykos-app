<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function index(Request $request)
    {
        $kos = Kos::query()
            ->where('is_active', true)
            ->when($request->q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nama', 'like', "%{$q}%")
                        ->orWhere('kota', 'like', "%{$q}%")
                        ->orWhere('area', 'like', "%{$q}%");
                });
            })
            ->when($request->kota, fn ($query, $kota) => $query->where('kota', $kota))
            ->when($request->tipe, fn ($query, $tipe) => $query->where('tipe', $tipe))
            ->when($request->harga_max, fn ($query, $harga) => $query->where('harga', '<=', $harga))
            ->when($request->sort === 'murah', fn ($query) => $query->orderBy('harga'))
            ->when($request->sort === 'mahal', fn ($query) => $query->orderByDesc('harga'))
            ->when(! $request->sort, fn ($query) => $query->latest())
            ->get();

        $daftarKota = Kos::where('is_active', true)->distinct()->orderBy('kota')->pluck('kota');

        $kosPeta = $kos->map(fn (Kos $k) => [
            'nama' => $k->nama,
            'kota' => $k->kota,
            'area' => $k->area,
            'harga' => $k->harga,
            'foto' => $k->foto_url,
            'lat' => $k->latitude,
            'lng' => $k->longitude,
            'url' => route('kos.show', $k),
        ])->values();

        return view('home', compact('kos', 'daftarKota', 'kosPeta'));
    }

    public function show(Kos $kos)
    {
        abort_unless($kos->is_active, 404);

        $kos->load('pemilik');

        return view('kos.show', compact('kos'));
    }
}
