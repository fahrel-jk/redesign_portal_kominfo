<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CMS Kominfo Jatim</title>
    <meta name="robots" content="noindex, nofollow">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            margin: 0;
        }
    </style>
</head>
<body class="antialiased">

    <div style="width: 100%; max-width: 400px;">
        <!-- Logo & brand -->
        <div style="text-align: center; margin-bottom: 28px;">
            <img src="{{ asset('images/logo_diskominfo-nobg.png') }}" alt="Logo Kominfo" style="height: 48px; margin: 0 auto 14px;">
            <h1 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0;">CMS Portal Layanan</h1>
            <p style="font-size: 13px; color: #64748b; font-weight: 500; margin: 6px 0 0;">Dinas Komunikasi dan Informatika Jawa Timur</p>
        </div>

        <!-- Login card -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 32px; box-shadow: 0 4px 16px rgba(0,0,0,0.04);">
            
            @if ($errors->any())
                <div style="margin-bottom: 24px; padding: 14px 16px; border-radius: 10px; background: #fef2f2; border: 1px solid #fecaca;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                        <i data-lucide="alert-circle" style="width: 16px; height: 16px; color: #dc2626;"></i>
                        <span style="font-size: 12.5px; font-weight: 700; color: #b91c1c;">Login gagal</span>
                    </div>
                    @foreach ($errors->all() as $error)
                        <p style="font-size: 12px; color: #dc2626; margin: 2px 0 0; font-weight: 500;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 7px;">Email</label>
                    <div style="position: relative;">
                        <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; display: flex;">
                            <i data-lucide="mail" style="width: 17px; height: 17px;"></i>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus 
                               style="width: 100%; padding: 11px 14px 11px 42px; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 14px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                               placeholder="admin@kominfo.jatimprov.go.id">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 7px;">Kata Sandi</label>
                    <div style="position: relative;">
                        <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; display: flex;">
                            <i data-lucide="lock" style="width: 17px; height: 17px;"></i>
                        </div>
                        <input type="password" name="password" id="password" required 
                               style="width: 100%; padding: 11px 14px 11px 42px; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 14px; font-weight: 500; color: #1e293b; outline: none; transition: border-color 0.15s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#93c5fd'" onblur="this.style.borderColor='#e2e8f0'"
                               placeholder="Masukkan kata sandi">
                    </div>
                </div>

                <div style="margin-bottom: 24px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="remember" style="width: 16px; height: 16px; accent-color: #1d4ed8; border-radius: 4px;">
                        <span style="font-size: 12.5px; font-weight: 500; color: #64748b;">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <button type="submit" style="width: 100%; padding: 12px; border-radius: 10px; background: #1d4ed8; color: #ffffff; font-size: 14px; font-weight: 700; border: none; cursor: pointer; transition: background 0.15s; display: flex; align-items: center; justify-content: center; gap: 8px;" onmouseover="this.style.background='#1e40af'" onmouseout="this.style.background='#1d4ed8'">
                    <i data-lucide="log-in" style="width: 17px; height: 17px;"></i>
                    Masuk
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    </script>
</body>
</html>
