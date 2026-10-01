@extends('admin.layout')

@section('title', 'Kelola Video')
@section('breadcrumb')
    <a href="{{ route('admin.videos.index') }}" style="color: #1e293b; text-decoration: none; font-weight: 700;">Video YouTube</a>
@endsection

@section('admin-content')
<div>
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 2px;">Kelola Video YouTube</h1>
            <p style="font-size: 13px; color: #64748b; font-weight: 500; margin: 0;">Kelola daftar video YouTube yang ditampilkan di landing page.</p>
        </div>
        <a href="{{ route('admin.videos.create') }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; border-radius: 10px; background: #1d4ed8; color: #ffffff; font-size: 13px; font-weight: 700; text-decoration: none;">
            <i data-lucide="plus" style="width: 16px; height: 16px;"></i> Tambah Video
        </a>
    </div>

    @if(session('success'))
        <div style="margin-bottom: 16px; padding: 12px 16px; border-radius: 10px; background: #ecfdf5; border: 1px solid #a7f3d0; font-size: 13px; color: #065f46; font-weight: 600;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <th style="padding: 14px 16px; text-align: left; font-weight: 700; color: #475569; font-size: 12px;">Thumbnail</th>
                    <th style="padding: 14px 16px; text-align: left; font-weight: 700; color: #475569; font-size: 12px;">Judul</th>
                    <th style="padding: 14px 16px; text-align: left; font-weight: 700; color: #475569; font-size: 12px;">Kategori</th>
                    <th style="padding: 14px 16px; text-align: left; font-weight: 700; color: #475569; font-size: 12px;">Tanggal</th>
                    <th style="padding: 14px 16px; text-align: center; font-weight: 700; color: #475569; font-size: 12px;">Status</th>
                    <th style="padding: 14px 16px; text-align: center; font-weight: 700; color: #475569; font-size: 12px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($videos as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px 16px;">
                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" style="width: 90px; height: 55px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                    </td>
                    <td style="padding: 12px 16px; font-weight: 600; color: #1e293b; max-width: 250px;">
                        <div style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $item->title }}</div>
                    </td>
                    <td style="padding: 12px 16px;">
                        <span style="display: inline-block; padding: 3px 10px; border-radius: 999px; background: #dbeafe; color: #1d4ed8; font-size: 11px; font-weight: 700;">{{ $item->category }}</span>
                    </td>
                    <td style="padding: 12px 16px; color: #64748b; font-size: 12px;">{{ $item->published_at?->format('d-m-Y H:i') ?? '-' }}</td>
                    <td style="padding: 12px 16px; text-align: center;">
                        <form action="{{ route('admin.videos.toggle', $item->id) }}" method="POST" style="display: inline;">
                            @csrf @method('PATCH')
                            <button type="submit" style="padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 700; border: none; cursor: pointer; {{ $item->is_active ? 'background: #dcfce7; color: #166534;' : 'background: #fef2f2; color: #991b1b;' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td style="padding: 12px 16px; text-align: center;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                            <a href="{{ route('admin.videos.edit', $item->id) }}" style="padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; color: #1d4ed8; background: #eff6ff; text-decoration: none;">Edit</a>
                            <form action="{{ route('admin.videos.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus video ini?')" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="submit" style="padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; color: #dc2626; background: #fef2f2; border: none; cursor: pointer;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 40px; text-align: center; color: #64748b;">
                        Belum ada video.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($videos->hasPages())
    <div style="margin-top: 16px;">
        {{ $videos->links() }}
    </div>
    @endif
</div>
@endsection
