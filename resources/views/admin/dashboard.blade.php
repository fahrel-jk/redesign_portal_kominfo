@extends('admin.layout')

@section('title', 'Dashboard')
@section('breadcrumb')
    <span style="font-weight: 700; color: #1e293b;">Dashboard</span>
@endsection

@section('admin-content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- Welcome header -->
    <div>
        <h1 style="font-size: 20px; font-weight: 700; color: #0f172a; margin: 0 0 4px;">Selamat datang, {{ Auth::user()->name ?? 'Admin' }}</h1>
        <p style="font-size: 13.5px; color: #64748b; font-weight: 400; margin: 0;">Ringkasan data portal layanan Kominfo Jawa Timur.</p>
    </div>

    <!-- Stats row -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <!-- Total layanan -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span style="font-size: 12px; font-weight: 600; color: #64748b;">Layanan</span>
                <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="layout-grid" style="width: 16px; height: 16px; color: #64748b;"></i>
                </div>
            </div>
            <div style="font-size: 28px; font-weight: 700; color: #0f172a; line-height: 1;">{{ $stats['total_services'] }}</div>
            <div style="margin-top: 8px; display: flex; align-items: center; gap: 12px; font-size: 12px; font-weight: 500;">
                <span style="color: #16a34a;">{{ $stats['active_services'] }} aktif</span>
                <span style="color: #94a3b8;">{{ $stats['inactive_services'] }} nonaktif</span>
            </div>
        </div>

        <!-- Kategori -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span style="font-size: 12px; font-weight: 600; color: #64748b;">Kategori</span>
                <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="layers" style="width: 16px; height: 16px; color: #64748b;"></i>
                </div>
            </div>
            <div style="font-size: 28px; font-weight: 700; color: #0f172a; line-height: 1;">{{ $stats['total_categories'] }}</div>
            <div style="margin-top: 8px; font-size: 12px; font-weight: 500; color: #64748b;">
                {{ $stats['active_categories'] }} kategori ditampilkan
            </div>
        </div>

        <!-- Akses domain -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span style="font-size: 12px; font-weight: 600; color: #64748b;">Domain</span>
                <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="globe" style="width: 16px; height: 16px; color: #64748b;"></i>
                </div>
            </div>
            <div style="font-size: 28px; font-weight: 700; color: #0f172a; line-height: 1;">{{ $stats['domain_services'] }}</div>
            <div style="margin-top: 8px; font-size: 12px; font-weight: 500; color: #64748b;">
                subdomain mandiri
            </div>
        </div>

        <!-- Akses path -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span style="font-size: 12px; font-weight: 600; color: #64748b;">Path</span>
                <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="link" style="width: 16px; height: 16px; color: #64748b;"></i>
                </div>
            </div>
            <div style="font-size: 28px; font-weight: 700; color: #0f172a; line-height: 1;">{{ $stats['path_services'] }}</div>
            <div style="margin-top: 8px; font-size: 12px; font-weight: 500; color: #64748b;">
                path terintegrasi
            </div>
        </div>
    </div>

    <!-- Quick actions -->
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ route('admin.services.create') }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #8BC4FE; color: #0f172a; border-radius: 6px; font-size: 13px; font-weight: 700; text-decoration: none; transition: background 0.15s;" onmouseover="this.style.background='#72b5fb'" onmouseout="this.style.background='#8BC4FE'">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
            Tambah Layanan
        </a>
        <a href="{{ route('admin.categories.create') }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #ffffff; color: #334155; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.borderColor='#cbd5e1';this.style.background='#f8fafc'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#ffffff'">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
            Tambah Kategori
        </a>
        <a href="{{ route('admin.news.create') }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #ffffff; color: #334155; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.borderColor='#cbd5e1';this.style.background='#f8fafc'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#ffffff'">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
            Tambah Berita
        </a>
        <a href="{{ route('admin.events.create') }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #ffffff; color: #334155; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.borderColor='#cbd5e1';this.style.background='#f8fafc'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#ffffff'">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
            Tambah Kegiatan
        </a>
    </div>

    <!-- Content stats row -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <!-- Berita -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span style="font-size: 12px; font-weight: 600; color: #64748b;">Berita</span>
                <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="newspaper" style="width: 16px; height: 16px; color: #64748b;"></i>
                </div>
            </div>
            <div style="font-size: 28px; font-weight: 700; color: #0f172a; line-height: 1;">{{ $stats['total_news'] }}</div>
            <div style="margin-top: 8px; font-size: 12px; font-weight: 500; color: #64748b;">
                {{ $stats['active_news'] }} aktif dipublikasi
            </div>
        </div>

        <!-- Kegiatan -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span style="font-size: 12px; font-weight: 600; color: #64748b;">Kegiatan</span>
                <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="calendar" style="width: 16px; height: 16px; color: #64748b;"></i>
                </div>
            </div>
            <div style="font-size: 28px; font-weight: 700; color: #0f172a; line-height: 1;">{{ $stats['total_events'] }}</div>
            <div style="margin-top: 8px; font-size: 12px; font-weight: 500; color: #64748b;">
                {{ $stats['active_events'] }} kegiatan aktif
            </div>
        </div>

        <!-- Galeri -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span style="font-size: 12px; font-weight: 600; color: #64748b;">Galeri Foto</span>
                <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="image" style="width: 16px; height: 16px; color: #64748b;"></i>
                </div>
            </div>
            <div style="font-size: 28px; font-weight: 700; color: #0f172a; line-height: 1;">{{ $stats['total_galleries'] }}</div>
            <div style="margin-top: 8px; font-size: 12px; font-weight: 500; color: #64748b;">
                {{ $stats['active_galleries'] }} foto ditampilkan
            </div>
        </div>
    </div>


    <!-- Two-column data section -->
    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 20px;">
        <!-- Recent services table -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
            <div style="padding: 18px 22px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h2 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0;">Layanan Terbaru</h2>
                    <p style="font-size: 12px; color: #94a3b8; margin: 3px 0 0; font-weight: 500;">5 layanan terakhir ditambahkan</p>
                </div>
                <a href="{{ route('admin.services.index') }}" style="font-size: 12px; font-weight: 700; color: #0284c7; text-decoration: none; display: flex; align-items: center; gap: 4px;" onmouseover="this.style.color='#0369a1'" onmouseout="this.style.color='#0284c7'">
                    Lihat Semua
                    <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                </a>            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                    <thead>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <th style="text-align: left; padding: 12px 22px; font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.3px;">Nama</th>
                            <th style="text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.3px;">Kategori</th>
                            <th style="text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.3px;">Akses</th>
                            <th style="text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.3px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentServices as $service)
                        <tr style="border-bottom: 1px solid #f8fafc;" onmouseover="this.style.background='#fafbfd'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 14px 22px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i data-lucide="{{ $service->icon ?: 'globe' }}" style="width: 15px; height: 15px; color: #475569;"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: #1e293b; font-size: 13px;">{{ $service->name }}</div>
                                        <div style="font-size: 11.5px; color: #94a3b8; font-weight: 500; max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $service->description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 14px 16px; font-weight: 600; color: #475569; font-size: 12.5px;">
                                {{ $service->category->name ?? '-' }}
                            </td>
                            <td style="padding: 14px 16px;">
                                @if($service->access_type === 'path')
                                    <span style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 6px; background: #f0fdf4; color: #15803d; font-size: 11.5px; font-weight: 700;">
                                        <i data-lucide="link" style="width: 12px; height: 12px;"></i> Path
                                    </span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 6px; background: rgba(139, 196, 254, 0.25); color: #0369a1; font-size: 11.5px; font-weight: 700;">
                                        <i data-lucide="globe" style="width: 12px; height: 12px;"></i> Domain
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 14px 16px;">
                                @if($service->is_active)
                                    <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></span>
                                @else
                                    <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #d1d5db;"></span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 40px 22px; text-align: center; color: #94a3b8; font-size: 13px;">
                                <div style="margin-bottom: 8px;"><i data-lucide="inbox" style="width: 28px; height: 28px; color: #cbd5e1;"></i></div>
                                Belum ada layanan terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Categories sidebar -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;">
            <div style="padding: 18px 20px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h2 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0;">Kategori</h2>
                    <p style="font-size: 12px; color: #94a3b8; margin: 3px 0 0; font-weight: 500;">Distribusi layanan</p>
                </div>
                <a href="{{ route('admin.categories.index') }}" style="font-size: 12px; font-weight: 700; color: #0284c7; text-decoration: none;" onmouseover="this.style.color='#0369a1'" onmouseout="this.style.color='#0284c7'">
                    Kelola
                </a>
            </div>

            <div style="padding: 8px 12px;">
                @foreach($recentCategories as $cat)
                <div style="padding: 12px; border-radius: 10px; display: flex; align-items: center; justify-content: space-between; transition: background 0.1s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 34px; height: 34px; border-radius: 9px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                            <i data-lucide="{{ $cat->icon ?: 'folder' }}" style="width: 16px; height: 16px; color: #475569;"></i>
                        </div>
                        <div>
                            <div style="font-size: 13px; font-weight: 600; color: #1e293b;">{{ $cat->name }}</div>
                            <div style="font-size: 11.5px; color: #94a3b8; font-weight: 500;">{{ $cat->slug }}</div>
                        </div>
                    </div>
                    <div style="padding: 4px 10px; background: #f1f5f9; border-radius: 6px; font-size: 12px; font-weight: 700; color: #475569;">
                        {{ $cat->services_count }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
