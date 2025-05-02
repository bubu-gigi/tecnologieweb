<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .dashboard-box {
            background: white;
            padding: 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.2rem;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="dashboard-box">
        <h1>Dashboard</h1>
        <p>Hello <strong>{{ Auth::user()->username }}</strong> 👋</p>
    </div>

</body>
</html>
