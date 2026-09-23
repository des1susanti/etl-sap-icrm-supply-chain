<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Rekonsiliasi</title>
    <style>
        @page { margin: 90px 30px 70px 30px; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 11px; color:#1f2937; }

        header { position: fixed; top:-70px; left:0; right:0; height:70px;
                 border-bottom:2px solid #1d4ed8; padding-bottom:8px; }
        header .company { font-size:15px; font-weight:bold; color:#1d4ed8; }
        header .subtitle { font-size:10px; color:#6b7280; margin-top:2px; }
        header .report-title { text-align:right; font-size:13px; font-weight:bold; color:#111827; }

        footer { position:fixed; bottom:-50px; left:0; right:0; height:50px;
                 border-top:1px solid #d1d5db; padding-top:6px; font-size:9px;
                 color:#9ca3af; text-align:center; }

        table.detail { width:100%; border-collapse:collapse; margin-top:14px; }
        table.detail th { background:#1d4ed8; color:#fff; padding:6px; font-size:10px; text-align:left; }
        table.detail td { padding:6px; font-size:10px; border-bottom:1px solid #e5e7eb; }

        .status-pill { display:inline-block; padding:2px 8px; border-radius:4px;
                        font-size:9.5px; font-weight:bold; color:#fff; }
        .status-completed { background:#16a34a; }
        .status-processing { background:#d97706; }
        .status-draft { background:#6b7280; }
    </style>
</head>
<body>
    <header>
        <table style="width:100%;">
            <tr>
                <td class="company">PLN Icon Plus</td>
                <td class="report-title">Laporan Rekonsiliasi</td>
            </tr>
            <tr>
                <td class="subtitle">Rekap Seluruh Data Rekonsiliasi</td>
                <td></td>
            </tr>
        </table>
    </header>

    <footer>
        Dicetak pada {{ now()->format('d M Y, H:i') }} WIB
    </footer>

    <table class="detail">
        <thead>
            <tr>
                <th style="width:5%;">#</th>
                <th style="width:15%;">ID Laporan</th>
                <th style="width:15%;">Periode</th>
                <th style="width:12%;">Total Item</th>
                <th style="width:12%;">Mismatch</th>
                <th style="width:20%;">Dibuat Oleh</th>
                <th style="width:13%;">Status</th>
                <th style="width:8%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reconciliations as $i => $rekon)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>REP-{{ str_pad($rekon->id, 8, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $rekon->periode }}</td>
                    <td>{{ number_format($rekon->total_count) }}</td>
                    <td>{{ number_format($rekon->mismatch_count) }}</td>
                    <td>{{ $rekon->user->name ?? '-' }}</td>
                    <td>
                        <span class="status-pill status-{{ $rekon->status }}">
                            {{ ucfirst($rekon->status) }}
                        </span>
                    </td>
                    <td>{{ $rekon->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>