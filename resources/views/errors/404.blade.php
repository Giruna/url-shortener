<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Not Found</title>
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
        h1 {
            margin-top: 0;
            color: #e3342f;
        }
    </style>
</head>
<body>
<div class="box">
    <h1>404 - Not Found</h1>
    <p>{{ $exception->getMessage() }}</p>

    <p><a href="/" style="color: #3490dc;">Vissza a főoldalra</a></p>
</div>
</body>
</html>
