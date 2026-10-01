@extends('admin.layout')

@section('title', 'Edit Foto Galeri')
@section('breadcrumb')
    <a href="{{ route('admin.galleries.index') }}" style="color: #94a3b8; text-decoration: none; font-weight: 600;">Galeri Foto</a>
    <i data-lucide="chevron-right" style="width: 14px; height: 14px; color: #cbd5e1;"></i>
    <span style="font-weight: 700; color: #1e293b;">Edit Foto</span>
@endsection

@section('admin-content')
<div style="max-width: 640px;">
    <a href="{{ route('admin.galleries.index') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; margin-bottom: 20px;">
        <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i> Kembali
    </a>

    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="padding: 22px 24px; border-bottom: 1px solid #f1f5f9;">
            <h1 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0;">Edit Item Galeri Foto</h1>
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

        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" style="padding: 24px;">
            @csrf
            @method('PUT')

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <label for="title" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Judul Foto / Event <span style="color: #dc2626;">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}" required 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label for="tag" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Kategori / Tag <span style="color: #dc2626;">*</span></label>
                        <input type="text" name="tag" id="tag" value="{{ old('tag', $gallery->tag) }}" required
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;">
                    </div>
                    <div>
                        <label for="sort_order" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Urutan Tampilan <span style="color: #dc2626;">*</span></label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" required
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                <div>
                    <label for="image" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Foto</label>
                    @if($gallery->image)
                        <div style="margin-bottom: 8px;">
                            <img src="{{ asset($gallery->image) }}" alt="Current" style="width: 200px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <span style="display: block; font-size: 11px; color: #64748b; margin-top: 4px;">Foto saat ini</span>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13px; color: #1e293b; box-sizing: border-box; background: #f8fafc;">
                    <span style="font-size: 11.5px; color: #64748b; margin-top: 4px; display: block;">Kosongkan jika tidak ingin mengubah foto</span>
                </div>

                <div>
                    <label for="event_datetime" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Tanggal / Waktu Kegiatan</label>
                    <input type="datetime-local" name="event_datetime" id="event_datetime" value="{{ old('event_datetime', $gallery->event_datetime ? $gallery->event_datetime->format('Y-m-d\TH:i') : '') }}" 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;">
                </div>

                <div>
                    <label for="description" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Keterangan Foto</label>
                    <textarea name="description" id="description" rows="3"
                              style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box; resize: vertical;">{{ old('description', $gallery->description) }}</textarea>
                </div>

                <div>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 10px 0;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #1d4ed8;">
                        <span style="font-size: 13px; font-weight: 600; color: #334155;">Tampilkan di Galeri Landing Page</span>
                    </label>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; margin-top: 28px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('admin.galleries.index') }}" style="padding: 10px 20px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #475569; text-decoration: none; background: #f1f5f9;">Batal</a>
                <button type="submit" style="padding: 10px 24px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #ffffff; background: #1d4ed8; border: none; cursor: pointer;">Perbarui Foto</button>
            </div>
        </form>
    </div>
</div>
@endsection
