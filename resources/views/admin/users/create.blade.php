@extends('admin.layout')

@section('title', 'Tambah Admin')
@section('breadcrumb')
    <a href="{{ route('admin.users.index') }}" style="color: #94a3b8; text-decoration: none; font-weight: 600;">Administrator</a>
    <i data-lucide="chevron-right" style="width: 14px; height: 14px; color: #cbd5e1;"></i>
    <span style="font-weight: 700; color: #1e293b;">Tambah Baru</span>
@endsection

@section('admin-content')
<div style="max-width: 640px;">

    <a href="{{ route('admin.users.index') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; margin-bottom: 20px;" onmouseover="this.style.color='#334155'" onmouseout="this.style.color='#64748b'">
        <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i> Kembali
    </a>

    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="padding: 22px 24px; border-bottom: 1px solid #f1f5f9;">
            <h1 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0;">Tambah Administrator Baru</h1>
            <p style="font-size: 12.5px; color: #94a3b8; margin: 4px 0 0; font-weight: 500;">Buat akun baru untuk pengelola CMS Portal.</p>
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

        <form action="{{ route('admin.users.store') }}" method="POST" style="padding: 24px;">
            @csrf

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <label for="name" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Lengkap <span style="color: #dc2626;">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                           placeholder="Nama administrator">
                </div>

                <div>
                    <label for="email" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Email Login <span style="color: #dc2626;">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                           style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                           placeholder="admin@kominfo.jatimprov.go.id">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label for="password" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Kata Sandi <span style="color: #dc2626;">*</span></label>
                        <input type="password" name="password" id="password" required 
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                               placeholder="Minimal 8 karakter">
                    </div>
                    <div>
                        <label for="password_confirmation" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Konfirmasi Sandi <span style="color: #dc2626;">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                               style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                               placeholder="Ulangi kata sandi">
                    </div>
                </div>

                <div>
                    <label for="role" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px;">Role <span style="color: #dc2626;">*</span></label>
                    <select name="role" id="role" required style="width: 100%; padding: 10px 14px; border-radius: 9px; border: 1px solid #e2e8f0; font-size: 13.5px; font-weight: 500; color: #1e293b; outline: none; background: #fff; box-sizing: border-box;">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Akses Penuh)</option>
                        <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator Katalog</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; margin-top: 28px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('admin.users.index') }}" style="padding: 10px 20px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #475569; text-decoration: none; background: #f1f5f9; transition: background 0.15s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Batal</a>
                <button type="submit" style="padding: 10px 24px; border-radius: 9px; font-size: 13px; font-weight: 700; color: #ffffff; background: #1d4ed8; border: none; cursor: pointer; transition: background 0.15s;" onmouseover="this.style.background='#1e40af'" onmouseout="this.style.background='#1d4ed8'">Simpan Admin</button>
            </div>
        </form>
    </div>
</div>
@endsection
