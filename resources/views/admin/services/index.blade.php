@extends('admin.layout')

@section('title', 'Daftar Layanan')
@section('breadcrumb')
    <a href="{{ route('admin.services.index') }}" style="color: #1e293b; text-decoration: none; font-weight: 700;">Layanan Digital</a>
@endsection

@section('admin-content')
<div style="display: flex; flex-direction: column; gap: 20px;">

    <!-- Page header -->
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 2px;">Layanan Digital</h1>
            <p style="font-size: 13px; color: #64748b; font-weight: 500; margin: 0;">Kelola katalog layanan, konfigurasi akses domain dan path.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #1d4ed8; color: #ffffff; border-radius: 10px; font-size: 13px; font-weight: 700; text-decoration: none; transition: background 0.15s;" onmouseover="this.style.background='#1e40af'" onmouseout="this.style.background='#1d4ed8'">
            <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
            Tambah Layanan
        </a>
    </div>

    <!-- Filter bar -->
    <form action="{{ route('admin.services.index') }}" method="GET" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 180px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama layanan..." 
                   style="width: 100%; padding: 8px 14px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; color: #334155; outline: none; transition: border-color 0.15s;"
                   onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'">
        </div>
        <select name="category_id" style="padding: 8px 14px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; color: #334155; outline: none; min-width: 160px;">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <select name="access_type" style="padding: 8px 14px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; color: #334155; outline: none; min-width: 140px;">
            <option value="">Semua Akses</option>
            <option value="domain" {{ request('access_type') == 'domain' ? 'selected' : '' }}>Domain</option>
            <option value="path" {{ request('access_type') == 'path' ? 'selected' : '' }}>Path</option>
        </select>
        <button type="submit" style="padding: 8px 18px; border-radius: 8px; background: #0f172a; color: #ffffff; font-size: 12.5px; font-weight: 700; border: none; cursor: pointer; transition: background 0.15s;" onmouseover="this.style.background='#1e293b'" onmouseout="this.style.background='#0f172a'">
            Filter
        </button>
        @if(request('search') || request('category_id') || request('access_type'))
            <a href="{{ route('admin.services.index') }}" style="padding: 8px 14px; font-size: 12.5px; font-weight: 600; color: #64748b; text-decoration: none;" onmouseover="this.style.color='#334155'" onmouseout="this.style.color='#64748b'">Reset</a>
        @endif
    </form>

    <!-- Table -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <th style="text-align: left; padding: 14px 22px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; width: 50px;">#</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Layanan</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Kategori</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Akses</th>
                        <th style="text-align: center; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                        <th style="text-align: right; padding: 14px 22px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr style="border-bottom: 1px solid #f8fafc;" onmouseover="this.style.background='#fafbfd'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 14px 22px; font-weight: 700; color: #cbd5e1; font-size: 12px;">
                            {{ $service->sort_order }}
                        </td>
                        <td style="padding: 14px 16px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <img src="{{ asset('images/logo_jatim.webp') }}" alt="{{ $service->name }}" style="width: 22px; height: 26px; object-fit: contain; flex-shrink: 0;">
                                <div>
                                    <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $service->name }}</div>
                                    <div style="font-size: 12px; color: #94a3b8; font-weight: 500; max-width: 260px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $service->description }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 14px 16px; font-weight: 600; color: #475569; font-size: 12.5px;">
                            {{ $service->category->name ?? '-' }}
                        </td>
                        <td style="padding: 14px 16px;">
                            @if($service->access_type === 'path')
                                <div>
                                    <span style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 6px; background: #f0fdf4; color: #15803d; font-size: 11.5px; font-weight: 700;">
                                        <i data-lucide="link" style="width: 12px; height: 12px;"></i> Path
                                    </span>
                                    <div style="font-size: 11.5px; color: #64748b; margin-top: 3px; font-family: monospace;">{{ $service->path }}</div>
                                </div>
                            @else
                                <div>
                                    <span style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 6px; background: #eff6ff; color: #1d4ed8; font-size: 11.5px; font-weight: 700;">
                                        <i data-lucide="globe" style="width: 12px; height: 12px;"></i> Domain
                                    </span>
                                    <div style="font-size: 11.5px; color: #64748b; margin-top: 3px; font-family: monospace; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $service->url }}</div>
                                </div>
                            @endif
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <form action="{{ route('admin.services.toggle', $service->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 6px; font-size: 11.5px; font-weight: 700; border: none; cursor: pointer; transition: all 0.15s; {{ $service->is_active ? 'background: #f0fdf4; color: #15803d;' : 'background: #f1f5f9; color: #94a3b8;' }}">
                                    @if($service->is_active)
                                        <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #22c55e;"></span> Aktif
                                    @else
                                        <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #cbd5e1;"></span> Nonaktif
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td style="padding: 14px 22px; text-align: right;">
                            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                                <a href="{{ route('admin.services.edit', $service->id) }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; color: #475569; text-decoration: none; transition: background 0.1s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'" title="Edit">
                                    <i data-lucide="pencil" style="width: 14px; height: 14px;"></i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #fef2f2; color: #dc2626; border: none; cursor: pointer; transition: background 0.1s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'" title="Hapus">
                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 48px 22px; text-align: center; color: #94a3b8; font-size: 13px;">
                            <div style="margin-bottom: 12px;"><i data-lucide="inbox" style="width: 32px; height: 32px; color: #cbd5e1;"></i></div>
                            <div style="font-weight: 600;">Belum ada layanan digital.</div>
                            <a href="{{ route('admin.services.create') }}" style="display: inline-flex; align-items: center; gap: 6px; margin-top: 12px; font-size: 12.5px; font-weight: 700; color: #2563eb; text-decoration: none;">
                                <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Tambah layanan pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($services->hasPages())
        <div style="padding: 14px 22px; border-top: 1px solid #f1f5f9; background: #fafbfd;">
            {{ $services->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
