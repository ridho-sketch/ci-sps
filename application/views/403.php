<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            font-size: 18px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>403 Forbidden</h1>
        <p>Directory access is forbidden.</p>
        <p>Go back to <a href="<?= base_url('home') ?>">home page</a>.</p>
    </div>
</body>
</html>
