@extends('admin.layout')

@section('title', 'Tambah Layanan')
@section('breadcrumb')
    <a href="{{ route('admin.services.index') }}" style="color: #94a3b8; text-decoration: none; font-weight: 600;">Layanan</a>
    <i data-lucide="chevron-right" style="width: 14px; height: 14px; color: #cbd5e1;"></i>
    <span style="font-weight: 700; color: #1e293b;">Tambah Baru</span>
@endsection

@section('admin-content')
<div style="max-width: 640px;">

    <a href="{{ route('admin.services.index') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; margin-bottom: 20px;" onmouseover="this.style.color='#334155'" onmouseout="this.style.color='#64748b'">
        <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i> Kembali
    </a>

    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="padding: 22px 24px; border-bottom: 1px solid #f1f5f9;">
            <h1 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0;">Tambah Layanan Baru</h1>
            <p style="font-size: 12.5px; color: #94a3b8; margin: 4px 0 0; font-weight: 500;">Daftarkan layanan digital baru ke katalog portal.</p>
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

        <form action="{{ route('admin.services.store') }}" method="POST" style="padding: 24px;">
            @csrf

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <!-- Name + Category -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label for="name" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Layanan <span style="color: #dc2626;">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                               placeholder="SIMA, Data Jatim, dll.">
                    </div>
                    <div>
                        <label for="service_category_id" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Kategori <span style="color: #dc2626;">*</span></label>
                        <select name="service_category_id" id="service_category_id" required 
                                style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; background: #fff; box-sizing: border-box;">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('service_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="slug" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                           placeholder="Otomatis dari nama jika dikosongkan">
                </div>

                <!-- Access type selection -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px;">
                    <label style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 12px;">Mode Akses <span style="color: #dc2626;">*</span></label>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 14px;">
                        <label style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; border-radius: 9px; background: #ffffff; border: 1px solid #e2e8f0; cursor: pointer; transition: border-color 0.15s;" onmouseover="this.style.borderColor='#93c5fd'" onmouseout="this.querySelector('input').checked ? this.style.borderColor='#3b82f6' : this.style.borderColor='#e2e8f0'">
                            <input type="radio" name="access_type" value="domain" {{ old('access_type', 'domain') == 'domain' ? 'checked' : '' }} onchange="toggleAccessFields('domain')" style="accent-color: #1d4ed8;">
                            <div>
                                <div style="font-size: 13px; font-weight: 700; color: #1e293b;">Domain</div>
                                <div style="font-size: 11px; color: #94a3b8; font-weight: 500;">Subdomain mandiri</div>
                            </div>
                        </label>
                        <label style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; border-radius: 9px; background: #ffffff; border: 1px solid #e2e8f0; cursor: pointer; transition: border-color 0.15s;" onmouseover="this.style.borderColor='#93c5fd'" onmouseout="this.querySelector('input').checked ? this.style.borderColor='#3b82f6' : this.style.borderColor='#e2e8f0'">
                            <input type="radio" name="access_type" value="path" {{ old('access_type') == 'path' ? 'checked' : '' }} onchange="toggleAccessFields('path')" style="accent-color: #1d4ed8;">
                            <div>
                                <div style="font-size: 13px; font-weight: 700; color: #1e293b;">Path</div>
                                <div style="font-size: 11px; color: #94a3b8; font-weight: 500;">Path terintegrasi (/sima)</div>
                            </div>
                        </label>
                    </div>

                    <div id="domain-field-container" class="{{ old('access_type', 'domain') == 'domain' ? '' : 'hidden' }}">
                        <label for="url" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">URL Domain</label>
                        <input type="url" name="url" id="url" value="{{ old('url') }}" 
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                               placeholder="https://sima.kominfo.jatimprov.go.id">
                    </div>

                    <div id="path-field-container" class="{{ old('access_type') == 'path' ? '' : 'hidden' }}">
                        <label for="path" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Path</label>
                        <div style="display: flex; align-items: center;">
                            <span style="padding: 10px 12px; background: #e2e8f0; color: #475569; font-size: 12px; font-weight: 700; border-radius: 9px 0 0 9px; border: 1px solid #e2e8f0; border-right: none; white-space: nowrap;">kominfo.jatimprov.go.id</span>
                            <input type="text" name="path" id="path" value="{{ old('path') }}" 
                                   style="flex: 1; padding: 10px 14px; border-radius: 0 9px 9px 0; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; box-sizing: border-box;"
                                   onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                                   placeholder="/sima">
                        </div>
                    </div>
                </div>



                <div>
                    <label for="description" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" 
                              style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; resize: vertical; transition: border-color 0.15s; box-sizing: border-box; font-family: inherit;"
                              onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                              placeholder="Deskripsi fungsi dan manfaat layanan ini...">{{ old('description') }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; align-items: end;">
                    <div>
                        <label for="sort_order" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Urutan</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 1) }}" min="0" required
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 10px 0;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} style="width: 18px; height: 18px; border-radius: 5px; accent-color: #1d4ed8;">
                            <span style="font-size: 13px; font-weight: 600; color: #334155;">Tampilkan di portal</span>
                        </label>
                    </div>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; margin-top: 28px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('admin.services.index') }}" style="padding: 10px 20px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #475569; text-decoration: none; background: #f1f5f9; transition: background 0.15s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Batal</a>
                <button type="submit" style="padding: 10px 24px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #ffffff; background: #1d4ed8; border: none; cursor: pointer; transition: background 0.15s;" onmouseover="this.style.background='#1e40af'" onmouseout="this.style.background='#1d4ed8'">Simpan Layanan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleAccessFields(type) {
        document.getElementById('domain-field-container').classList.toggle('hidden', type !== 'domain');
        document.getElementById('path-field-container').classList.toggle('hidden', type !== 'path');
    }
</script>
@endsection
