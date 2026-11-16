@php
    $warna = match ($status) {
        'menunggu' => 'bg-[#fdf3e0] text-[#8a5a12]',
        'diterima' => 'bg-[#e7efec] text-pine',
        'ditolak' => 'bg-[#fdeee9] text-accentdark',
        'selesai' => 'bg-[#e8e8f0] text-[#3d3d5c]',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp
<span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold {{ $warna }}">{{ ucfirst($status) }}</span>
