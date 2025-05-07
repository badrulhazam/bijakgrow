<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Public Gold</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(to bottom, #fff0f0, #ffecec);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .logo {
            width: 150px;
            margin-bottom: 20px;
        }

        .card {
            background: linear-gradient(to bottom right, #ff4d4d, #ff6666);
            color: white;
            padding: 25px;
            border-radius: 16px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(255, 77, 77, 0.3);
            text-align: center;
            position: relative;
            animation: slideIn 0.6s ease-in-out;
        }

        .card h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .profile-img {
            width: 120px;
            height: auto;
            border-radius: 12px;
            margin: 0 auto 16px;
            display: block;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .info-box {
            background-color: white;
            color: #333;
            padding: 12px;
            border-radius: 8px;
            text-align: left;
            margin: 0 auto 20px;
        }

        .info-box strong {
            display: block;
        }

        .button {
            background-color: white;
            color: #d63031;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button:hover {
            background-color: #fcecec;
            transform: scale(1.05);
        }

        .footer {
            font-size: 12px;
            color: #e6e6e6;
            margin-top: 16px;
        }

        .tagline {
            margin-top: 30px;
            font-size: 14px;
            color: #444;
            font-style: italic;
            text-align: center;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media screen and (max-width: 480px) {
            .card {
                padding: 20px;
            }

            .logo {
                width: 120px;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <img src="/images/g100_logo.png" alt="G100 Logo" class="logo">

    <div class="card">
        <h2>🧧 Profil Dealer Public Gold</h2>

        <img src="/images/3.png" alt="Dealer" class="profile-img">

        <div class="info-box">
            <strong>Nama:</strong> Mohd Badruhazam<br>
            <strong>Kod PG:</strong> PG00651763
        </div>

        <a href="http://127.0.0.1:8000/investment">
            <button class="button">📘 Buka Kalkulator Emas</button>
        </a>
		<a href="{{ route('investment') }}" class="btn btn-primary">Kalkulator Emas</a>


        <div class="footer">
            Powered by <a href="#" style="color: white; text-decoration: underline;">badruhazam</a>
        </div>
    </div>

    <div class="tagline">
        “Bantu anda simpan emas dengan ilmu dan yakin.”
    </div>
</body>

</html>
