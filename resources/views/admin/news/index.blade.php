@extends('admin.layout')

@section('title', 'Kelola Berita')
@section('breadcrumb')
    <a href="{{ route('admin.news.index') }}" style="color: #1e293b; text-decoration: none; font-weight: 700;">Berita & Kabar</a>
@endsection

@section('admin-content')
<div style="display: flex; flex-direction: column; gap: 20px;">

    <!-- Page header -->
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 2px;">Kelola Berita & Kabar Jatim</h1>
            <p style="font-size: 13px; color: #64748b; font-weight: 500; margin: 0;">Kelola konten berita publik yang tampil di portal utama.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #1d4ed8; color: #ffffff; border-radius: 10px; font-size: 13px; font-weight: 700; text-decoration: none; transition: background 0.15s;" onmouseover="this.style.background='#1e40af'" onmouseout="this.style.background='#1d4ed8'">
            <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
            Tambah Berita
        </a>
    </div>

    <!-- Filter bar -->
    <form action="{{ route('admin.news.index') }}" method="GET" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 180px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita..." 
                   style="width: 100%; padding: 8px 14px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; color: #334155; outline: none;"
                   onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'">
        </div>
        <select name="category" style="padding: 8px 14px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; color: #334155; outline: none; min-width: 160px;">
            <option value="">Semua Kategori</option>
            <option value="pemerintahan" {{ request('category') == 'pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
            <option value="digital" {{ request('category') == 'digital' ? 'selected' : '' }}>Digitalisasi</option>
            <option value="pengumuman" {{ request('category') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
        </select>
        <button type="submit" style="padding: 8px 18px; border-radius: 8px; background: #0f172a; color: #ffffff; font-size: 12.5px; font-weight: 700; border: none; cursor: pointer;">
            Filter
        </button>
        @if(request('search') || request('category'))
            <a href="{{ route('admin.news.index') }}" style="padding: 8px 14px; font-size: 12.5px; font-weight: 600; color: #64748b; text-decoration: none;">Reset</a>
        @endif
    </form>

    <!-- Table -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <th style="text-align: left; padding: 14px 22px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; width: 60px;">ID</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Judul Berita</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Kategori</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Tanggal</th>
                        <th style="text-align: center; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Status</th>
                        <th style="text-align: right; padding: 14px 22px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                    <tr style="border-bottom: 1px solid #f8fafc;" onmouseover="this.style.background='#fafbfd'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 14px 22px; font-weight: 700; color: #cbd5e1; font-size: 12px;">
                            #{{ $item->id }}
                        </td>
                        <td style="padding: 14px 16px;">
                            <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $item->title }}</div>
                            <div style="font-size: 12px; color: #94a3b8; font-weight: 500; max-width: 320px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $item->summary }}</div>
                        </td>
                        <td style="padding: 14px 16px;">
                            <span style="display: inline-block; padding: 3px 10px; border-radius: 6px; background: #e0f2fe; color: #0369a1; font-size: 11.5px; font-weight: 700; text-transform: capitalize;">
                                {{ $item->category }}
                            </span>
                        </td>
                        <td style="padding: 14px 16px; font-weight: 500; color: #64748b; font-size: 12.5px;">
                            {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <form action="{{ route('admin.news.toggle', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 6px; font-size: 11.5px; font-weight: 700; border: none; cursor: pointer; {{ $item->is_active ? 'background: #f0fdf4; color: #15803d;' : 'background: #f1f5f9; color: #94a3b8;' }}">
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td style="padding: 14px 22px; text-align: right;">
                            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                                <a href="{{ route('admin.news.edit', $item->id) }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; color: #475569; text-decoration: none;" title="Edit">
                                    <i data-lucide="pencil" style="width: 14px; height: 14px;"></i>
                                </a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #fef2f2; color: #dc2626; border: none; cursor: pointer;" title="Hapus">
                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 48px 22px; text-align: center; color: #94a3b8; font-size: 13px;">
                            Belum ada berita.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($news->hasPages())
        <div style="padding: 14px 22px; border-top: 1px solid #f1f5f9; background: #fafbfd;">
            {{ $news->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
