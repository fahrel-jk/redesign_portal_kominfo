@extends('admin.layout')

@section('title', 'Tambah Video')
@section('breadcrumb')
    <a href="{{ route('admin.videos.index') }}" style="color: #94a3b8; text-decoration: none; font-weight: 600;">Video YouTube</a>
    <i data-lucide="chevron-right" style="width: 14px; height: 14px; color: #cbd5e1;"></i>
    <span style="font-weight: 700; color: #1e293b;">Tambah Baru</span>
@endsection

@section('admin-content')
<div style="max-width: 640px;">
    <a href="{{ route('admin.videos.index') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; margin-bottom: 20px;">
        <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i> Kembali
    </a>

    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="padding: 22px 24px; border-bottom: 1px solid #f1f5f9;">
            <h1 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0;">Tambah Video YouTube</h1>
        </div>

        @if ($errors->any())
            <div style="margin: 20px 24px 0; padding: 14px 16px; border-radius: 10px; background: #fef2f2; border: 1px solid #fecaca;">
                <ul style="margin: 0; padding-left: 18px; font-size: 12px; color: #dc2626; font-weight: 500;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" style="padding: 24px;">
            @csrf

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <label for="title" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Judul Video <span style="color: #dc2626;">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;"
                           placeholder="Contoh: Info Jatim Minggu Ke-4 September 2026">
                </div>

                <div>
                    <label for="youtube_url" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">URL YouTube <span style="color: #dc2626;">*</span></label>
                    <input type="text" name="youtube_url" id="youtube_url" value="{{ old('youtube_url') }}" required
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;"
                           placeholder="https://www.youtube.com/watch?v=xxxxx">
                    <span style="font-size: 11.5px; color: #64748b; margin-top: 4px; display: block;">Bisa URL penuh, URL pendek (youtu.be), atau ID video saja</span>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label for="category" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Kategori <span style="color: #dc2626;">*</span></label>
                        <select name="category" id="category" required style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; background: #fff; box-sizing: border-box;">
                            <option value="UMUM" {{ old('category') == 'UMUM' ? 'selected' : '' }}>UMUM</option>
                            <option value="INFO JATIM" {{ old('category') == 'INFO JATIM' ? 'selected' : '' }}>INFO JATIM</option>
                            <option value="PODCAST" {{ old('category') == 'PODCAST' ? 'selected' : '' }}>PODCAST</option>
                            <option value="TUTORIAL" {{ old('category') == 'TUTORIAL' ? 'selected' : '' }}>TUTORIAL</option>
                        </select>
                    </div>
                    <div>
                        <label for="published_at" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Tanggal Rilis</label>
                        <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}"
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                <div>
                    <label for="thumbnail" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Thumbnail Kustom (Opsional)</label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13px; color: #1e293b; box-sizing: border-box; background: #f8fafc;">
                    <span style="font-size: 11.5px; color: #64748b; margin-top: 4px; display: block;">Jika kosong, thumbnail otomatis dari YouTube</span>
                </div>

                <div>
                    <label for="description" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                              style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box; resize: vertical;"
                              placeholder="Deskripsi singkat video">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 10px 0;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #1d4ed8;">
                        <span style="font-size: 13px; font-weight: 600; color: #334155;">Tampilkan Video</span>
                    </label>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; margin-top: 28px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('admin.videos.index') }}" style="padding: 10px 20px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #475569; text-decoration: none; background: #f1f5f9;">Batal</a>
                <button type="submit" style="padding: 10px 24px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #ffffff; background: #1d4ed8; border: none; cursor: pointer;">Simpan Video</button>
            </div>
        </form>
    </div>
</div>
@endsection
