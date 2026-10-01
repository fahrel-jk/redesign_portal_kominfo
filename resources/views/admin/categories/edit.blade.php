@extends('admin.layout')

@section('title', 'Edit Kategori')
@section('breadcrumb')
    <a href="{{ route('admin.categories.index') }}" style="color: #94a3b8; text-decoration: none; font-weight: 600;">Kategori</a>
    <i data-lucide="chevron-right" style="width: 14px; height: 14px; color: #cbd5e1;"></i>
    <span style="font-weight: 700; color: #1e293b;">Edit</span>
@endsection

@section('admin-content')
<div style="max-width: 640px;">

    <a href="{{ route('admin.categories.index') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; margin-bottom: 20px;" onmouseover="this.style.color='#334155'" onmouseout="this.style.color='#64748b'">
        <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i> Kembali
    </a>

    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="padding: 22px 24px; border-bottom: 1px solid #f1f5f9;">
            <h1 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0;">Edit: {{ $category->name }}</h1>
        </div>

        @if ($errors->any())
            <div style="margin: 20px 24px 0; padding: 14px 16px; border-radius: 10px; background: #fef2f2; border: 1px solid #fecaca;">
                <div style="font-size: 12.5px; font-weight: 700; color: #b91c1c; margin-bottom: 6px;">Terdapat kesalahan:</div>
                <ul style="margin: 0; padding-left: 18px; font-size: 12px; color: #dc2626; font-weight: 500;">
                    @foreach ($errors->all() as $error)
                        <li style="margin-bottom: 2px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" style="padding: 24px;">
            @csrf
            @method('PUT')

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <label for="name" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Kategori <span style="color: #dc2626;">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'">
                </div>

                <div>
                    <label for="slug" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'">
                </div>

                <div>
                    <label for="icon" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Ikon</label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $category->icon) }}" 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'">
                    <p style="font-size: 11.5px; color: #94a3b8; margin: 5px 0 0; font-weight: 500;">Nama ikon dari <a href="https://lucide.dev/icons" target="_blank" style="color: #2563eb; text-decoration: none; font-weight: 600;">Lucide Icons</a></p>
                </div>

                <div>
                    <label for="description" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" 
                              style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; resize: vertical; transition: border-color 0.15s; box-sizing: border-box; font-family: inherit;"
                              onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'">{{ old('description', $category->description) }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; align-items: end;">
                    <div>
                        <label for="sort_order" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Urutan</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0" required
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 10px 0;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px; border-radius: 5px; accent-color: #1d4ed8;">
                            <span style="font-size: 13px; font-weight: 600; color: #334155;">Tampilkan di portal</span>
                        </label>
                    </div>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; margin-top: 28px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('admin.categories.index') }}" style="padding: 10px 20px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #475569; text-decoration: none; background: #f1f5f9; transition: background 0.15s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Batal</a>
                <button type="submit" style="padding: 10px 24px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #ffffff; background: #1d4ed8; border: none; cursor: pointer; transition: background 0.15s;" onmouseover="this.style.background='#1e40af'" onmouseout="this.style.background='#1d4ed8'">Perbarui Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection
