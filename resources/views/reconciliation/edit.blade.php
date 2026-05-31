<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rekonsiliasi</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Poppins',sans-serif;
            background:#f0f3f9;
            padding:40px;
        }

        .card{
            background:white;
            max-width:600px;
            margin:auto;
            padding:30px;
            border-radius:16px;
            box-shadow:0 2px 10px rgba(0,0,0,0.06);
        }

        h2{
            margin-bottom:24px;
            color:#0d1f3c;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
            color:#334155;
        }

        input{
            width:100%;
            height:44px;
            border:1px solid #dbe2ea;
            border-radius:10px;
            padding:0 14px;
            font-size:14px;
            margin-bottom:20px;
        }

        button{
            background:#2563eb;
            color:white;
            border:none;
            padding:12px 22px;
            border-radius:10px;
            cursor:pointer;
            font-weight:600;
        }

        button:hover{
            background:#1d4ed8;
        }
    </style>
</head>
<body>

<div class="card">

    <h2>✏️ Edit Rekonsiliasi</h2>

    <form action="{{ route('reconciliation.update', $rekon->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Periode</label>

    <input type="month"
           name="periode"
           value="{{ \Carbon\Carbon::parse($rekon->periode)->format('Y-m') }}">

    <button type="submit">Simpan</button>
</form>

</div>

</body>
</html>