@extends('admin.layout')

@section('title', 'Kategori Layanan')
@section('breadcrumb')
    <a href="{{ route('admin.categories.index') }}" style="color: #1e293b; text-decoration: none; font-weight: 700;">Kategori</a>
@endsection

@section('admin-content')
<div style="display: flex; flex-direction: column; gap: 20px;">

    <!-- Page header -->
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 2px;">Kategori Layanan</h1>
            <p style="font-size: 13px; color: #64748b; font-weight: 500; margin: 0;">Pengelompokan layanan digital Kominfo Jawa Timur.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #1d4ed8; color: #ffffff; border-radius: 10px; font-size: 13px; font-weight: 700; text-decoration: none; transition: background 0.15s;" onmouseover="this.style.background='#1e40af'" onmouseout="this.style.background='#1d4ed8'">
            <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
            Tambah Kategori
        </a>
    </div>

    <!-- Table -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <th style="text-align: left; padding: 14px 22px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; width: 60px;">#</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Kategori</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Slug</th>
                        <th style="text-align: center; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Layanan</th>
                        <th style="text-align: center; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                        <th style="text-align: right; padding: 14px 22px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr style="border-bottom: 1px solid #f8fafc;" onmouseover="this.style.background='#fafbfd'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 14px 22px; font-weight: 700; color: #cbd5e1; font-size: 12px;">
                            {{ $category->sort_order }}
                        </td>
                        <td style="padding: 14px 16px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 34px; height: 34px; border-radius: 9px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i data-lucide="{{ $category->icon ?: 'folder' }}" style="width: 16px; height: 16px; color: #475569;"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $category->name }}</div>
                                    @if($category->description)
                                        <div style="font-size: 12px; color: #94a3b8; font-weight: 500; max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $category->description }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="padding: 14px 16px;">
                            <code style="font-size: 12px; color: #64748b; background: #f1f5f9; padding: 3px 8px; border-radius: 5px;">{{ $category->slug }}</code>
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <span style="font-size: 13px; font-weight: 800; color: #334155;">{{ $category->services_count }}</span>
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <form action="{{ route('admin.categories.toggle', $category->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 6px; font-size: 11.5px; font-weight: 700; border: none; cursor: pointer; transition: all 0.15s; {{ $category->is_active ? 'background: #f0fdf4; color: #15803d;' : 'background: #f1f5f9; color: #94a3b8;' }}">
                                    @if($category->is_active)
                                        <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #22c55e;"></span> Tampil
                                    @else
                                        <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #cbd5e1;"></span> Sembunyi
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td style="padding: 14px 22px; text-align: right;">
                            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; color: #475569; text-decoration: none; transition: background 0.1s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'" title="Edit">
                                    <i data-lucide="pencil" style="width: 14px; height: 14px;"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini? Seluruh layanan di bawahnya akan ikut terhapus.')" style="display: inline;">
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
                            <div style="margin-bottom: 12px;"><i data-lucide="folder-open" style="width: 32px; height: 32px; color: #cbd5e1;"></i></div>
                            <div style="font-weight: 600;">Belum ada kategori.</div>
                            <a href="{{ route('admin.categories.create') }}" style="display: inline-flex; align-items: center; gap: 6px; margin-top: 12px; font-size: 12.5px; font-weight: 700; color: #2563eb; text-decoration: none;">
                                <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Tambah kategori pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
