@extends('admin.layout')

@section('title', 'Administrator')
@section('breadcrumb')
    <a href="{{ route('admin.users.index') }}" style="color: #1e293b; text-decoration: none; font-weight: 700;">Administrator</a>
@endsection

@section('admin-content')
<div style="display: flex; flex-direction: column; gap: 20px;">

    <!-- Page header -->
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 2px;">Administrator</h1>
            <p style="font-size: 13px; color: #64748b; font-weight: 500; margin: 0;">Pengelola yang memiliki akses ke CMS Portal.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #1d4ed8; color: #ffffff; border-radius: 10px; font-size: 13px; font-weight: 700; text-decoration: none; transition: background 0.15s;" onmouseover="this.style.background='#1e40af'" onmouseout="this.style.background='#1d4ed8'">
            <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
            Tambah Admin
        </a>
    </div>

    <!-- Table -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <th style="text-align: left; padding: 14px 22px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Administrator</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Email</th>
                        <th style="text-align: center; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Role</th>
                        <th style="text-align: left; padding: 14px 16px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Bergabung</th>
                        <th style="text-align: right; padding: 14px 22px; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr style="border-bottom: 1px solid #f8fafc;" onmouseover="this.style.background='#fafbfd'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 14px 22px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 36px; height: 36px; border-radius: 9px; background: #1d4ed8; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; flex-shrink: 0;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td style="padding: 14px 16px; font-weight: 500; color: #64748b; font-size: 13px;">
                            {{ $user->email }}
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 6px; font-size: 11.5px; font-weight: 700; text-transform: capitalize; {{ $user->role === 'admin' ? 'background: #eff6ff; color: #1d4ed8;' : 'background: #f1f5f9; color: #475569;' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td style="padding: 14px 16px; font-size: 12.5px; color: #94a3b8; font-weight: 500;">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                        </td>
                        <td style="padding: 14px 22px; text-align: right;">
                            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                                <a href="{{ route('admin.users.edit', $user->id) }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; color: #475569; text-decoration: none; transition: background 0.1s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'" title="Edit">
                                    <i data-lucide="pencil" style="width: 14px; height: 14px;"></i>
                                </a>
                                @if($users->count() > 1)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus admin ini?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #fef2f2; color: #dc2626; border: none; cursor: pointer; transition: background 0.1s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'" title="Hapus">
                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 48px 22px; text-align: center; color: #94a3b8; font-size: 13px;">
                            <div style="margin-bottom: 12px;"><i data-lucide="shield" style="width: 32px; height: 32px; color: #cbd5e1;"></i></div>
                            <div style="font-weight: 600;">Belum ada administrator.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
