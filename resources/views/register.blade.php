<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            background: #28a745;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .register-box {
            background: #ffffff;
            padding: 40px 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
        }
        input[type="text"], input[type="password"] {
            width: 95%;
            margin: 10px 0;
            padding: 10px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }
        .message {
            margin-bottom: 10px;
            color: green;
        }
        .form-group {
            
            margin-bottom: 15px;
        }
        a {
            text-decoration: none;
        }
        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Register</h2>
        @if (session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif
        <form method="POST" action="/register">
            @csrf
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Daftar</button>
            <div class="form-group"><p>Sudah punya akun? <a href="/login">login</a></p></div>
        </form>
    </div>
</body>
</html>
