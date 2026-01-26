@extends('themes.default.common.master')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Full</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: #ffffff;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .card h2 {
            color: #dc3545;
            margin-bottom: 15px;
        }
        .card p {
            color: #555;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="card">
        <h2>Event Fully Booked</h2>

        <p>
            Thank you for your interest in <strong>OneRun 2026</strong>.
        </p>

        <p>
            {{ $message ?? 'This event is currently full.' }}
        </p>

        <a href="{{ url('/') }}" class="btn">Go to Home</a>
    </div>
</div>

</body>
</html>
@endsection
