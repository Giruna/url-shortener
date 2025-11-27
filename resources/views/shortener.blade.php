<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>URL rövidítő</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 40px;
            background: #f8fafc;
            color: #333;
        }
        .box {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="box">
    <h1>URL rövidítő</h1>

    @if(session('shortUrl'))
        <p>Rövidített URL: <a href="{{ session('shortUrl') }}">{{ session('shortUrl') }}</a></p>
    @endif

    <form action="{{ route('shorten') }}" method="POST">
        @csrf
        <label for="long_url">Hosszú URL:</label>
        <input type="url" id="long_url" name="long_url" required>
        <button type="submit">Rövidítés</button>
    </form>
</div>
</body>
</html>
