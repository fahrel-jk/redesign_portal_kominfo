@extends('admin.layout')

@section('title', 'Edit Berita')
@section('breadcrumb')
    <a href="{{ route('admin.news.index') }}" style="color: #94a3b8; text-decoration: none; font-weight: 600;">Berita</a>
    <i data-lucide="chevron-right" style="width: 14px; height: 14px; color: #cbd5e1;"></i>
    <span style="font-weight: 700; color: #1e293b;">Edit</span>
@endsection

@section('admin-content')
<div style="max-width: 640px;">
    <a href="{{ route('admin.news.index') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; margin-bottom: 20px;">
        <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i> Kembali
    </a>

    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="padding: 22px 24px; border-bottom: 1px solid #f1f5f9;">
            <h1 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0;">Edit: {{ $news->title }}</h1>
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

        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" style="padding: 24px;">
            @csrf
            @method('PUT')

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <label for="title" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Judul Berita <span style="color: #dc2626;">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label for="category" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Kategori <span style="color: #dc2626;">*</span></label>
                        <select name="category" id="category" required style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; background: #fff; box-sizing: border-box;">
                            <option value="pemerintahan" {{ old('category', $news->category) == 'pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
                            <option value="digital" {{ old('category', $news->category) == 'digital' ? 'selected' : '' }}>Digitalisasi</option>
                            <option value="pengumuman" {{ old('category', $news->category) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                    </div>
                    <div>
                        <label for="published_at" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Tanggal Rilis</label>
                        <input type="date" name="published_at" id="published_at" value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d') : '') }}"
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                <div>
                    <label for="image" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Foto Berita</label>
                    @if($news->image)
                        <div style="margin-bottom: 8px;">
                            <img src="{{ asset($news->image) }}" alt="Current" style="width: 200px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <span style="display: block; font-size: 11px; color: #64748b; margin-top: 4px;">Foto saat ini</span>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13px; color: #1e293b; box-sizing: border-box; background: #f8fafc;">
                    <span style="font-size: 11.5px; color: #64748b; margin-top: 4px; display: block;">Kosongkan jika tidak ingin mengubah foto</span>
                </div>

                <div>
                    <label for="summary" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Ringkasan Berita</label>
                    <textarea name="summary" id="summary" rows="3" style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box; font-family: inherit;">{{ old('summary', $news->summary) }}</textarea>
                </div>

                <div>
                    <label for="content" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Isi Berita Lengkap</label>
                    <textarea name="content" id="content" rows="6" style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box; font-family: inherit;">{{ old('content', $news->content) }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; align-items: end;">
                    <div>
                        <label for="read_time" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Waktu Baca</label>
                        <input type="text" name="read_time" id="read_time" value="{{ old('read_time', $news->read_time) }}"
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 10px 0;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $news->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #1d4ed8;">
                            <span style="font-size: 13px; font-weight: 600; color: #334155;">Tampilkan Berita</span>
                        </label>
                    </div>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; margin-top: 28px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('admin.news.index') }}" style="padding: 10px 20px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #475569; text-decoration: none; background: #f1f5f9;">Batal</a>
                <button type="submit" style="padding: 10px 24px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #ffffff; background: #1d4ed8; border: none; cursor: pointer;">Perbarui Berita</button>
            </div>
        </form>
    </div>
</div>
@endsection
