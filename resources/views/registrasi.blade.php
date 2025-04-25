<!DOCTYPE html>
<html>
<head>
    <title>Form Registrasi</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        form { max-width: 400px; margin: auto; }
        input { width: 100%; padding: 8px; margin: 10px 0; }
        button { padding: 10px 15px; background: #4CAF50; color: white; border: none; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h2>Registrasi Akun Baru</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form action="{{ route('registrasi.store') }}" method="POST">
        @csrf
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Daftar</button>
    </form>
</body>
</html>
