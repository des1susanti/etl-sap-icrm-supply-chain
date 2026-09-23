<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekonsiliasi REP-{{ str_pad($rekon->id, 8, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page { margin: 90px 30px 70px 30px; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 11px; color:#1f2937; }

        header { position: fixed; top:-70px; left:0; right:0; height:70px;
                 border-bottom:2px solid #1d4ed8; padding-bottom:8px; }
        header .company { font-size:15px; font-weight:bold; color:#1d4ed8; }
        header .subtitle { font-size:10px; color:#6b7280; margin-top:2px; }
        header .report-title { text-align:right; font-size:13px; font-weight:bold; color:#111827; }
        header .report-id { text-align:right; font-size:10px; color:#6b7280; margin-top:2px; }

        footer { position:fixed; bottom:-50px; left:0; right:0; height:50px;
                 border-top:1px solid #d1d5db; padding-top:6px; font-size:9px;
                 color:#9ca3af; text-align:center; }

        .info-table { width:100%; margin-bottom:14px; border-collapse:collapse; }
        .info-table td { padding:3px 0; font-size:10.5px; vertical-align:top; }
        .info-table td.label { width:130px; color:#6b7280; }
        .info-table td.sep { width:10px; color:#6b7280; }
        .info-table td.value { font-weight:bold; color:#111827; }

        .status-pill { display:inline-block; padding:2px 8px; border-radius:4px;
                        font-size:9.5px; font-weight:bold; color:#fff; }
        .status-completed { background:#16a34a; }
        .status-draft { background:#9ca3af; }
        .status-processing { background:#f59e0b; }
        .status-failed { background:#dc2626; }

        .section-title { font-size:12px; font-weight:bold; color:#1d4ed8;
                          margin:14px 0 6px 0; border-bottom:1px solid #e5e7eb; padding-bottom:4px; }

        table.summary { width:100%; border-collapse:collapse; margin-bottom:6px; }
        table.summary td { width:20%; border:1px solid #e5e7eb; text-align:center; padding:8px 4px; }
        table.summary .num { font-size:16px; font-weight:bold; display:block; }
        table.summary .lbl { font-size:9px; color:#6b7280; text-transform:uppercase; }
        .num-total{color:#1d4ed8;} .num-match{color:#16a34a;} .num-mismatch{color:#dc2626;}
        .num-sap{color:#d97706;} .num-icrm{color:#0284c7;}

        table.detail { width:100%; border-collapse:collapse; font-size:9px; }
        table.detail th { background:#1d4ed8; color:#fff; padding:5px 4px; text-align:left; font-size:9px; }
        table.detail td { padding:4px; border-bottom:1px solid #e5e7eb; }
        table.detail tr:nth-child(even) { background:#f8fafc; }
        .badge { padding:2px 6px; border-radius:3px; font-weight:bold; font-size:8.5px; color:#fff; }
        .badge-match { background:#16a34a; }
        .badge-mismatch { background:#dc2626; }

        .signature-wrap { width:100%; margin-top:40px; page-break-inside:avoid; }
        table.signature { width:100%; border-collapse:collapse; }
        table.signature td { width:50%; text-align:center; font-size:10px; vertical-align:top; }
        .signature-space { height:60px; }
        .signature-line { border-top:1px solid #111827; margin:0 30px; padding-top:4px; font-weight:bold; }
    </style>
</head>
<body>

    <header>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="width:60%;">
                    <div class="company">PT PLN ICON PLUS</div>
                    <div class="subtitle">Laporan Rekonsiliasi Data SAP &amp; ICRM+ — Wilayah Jambi</div>
                </td>
                <td style="width:40%;">
                    <div class="report-title">LAPORAN REKONSILIASI</div>
                    <div class="report-id">REP-{{ str_pad($rekon->id, 8, '0', STR_PAD_LEFT) }}</div>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        Dicetak otomatis oleh Sistem ETL Rekonsiliasi ICON PLUS Jambi — {{ now()->format('d M Y, H:i') }}
    </footer>

    <table class="info-table">
        <tr>
            <td class="label">Periode Rekonsiliasi</td><td class="sep">:</td>
            <td class="value">{{ $rekon->periode ?? '-' }}</td>
            <td class="label">Status</td><td class="sep">:</td>
            <td class="value">
                @php
                    $statusMap = [
                        'completed'  => ['label'=>'Sinkron (Approved)', 'class'=>'status-completed'],
                        'draft'      => ['label'=>'Draft', 'class'=>'status-draft'],
                        'processing' => ['label'=>'Processing', 'class'=>'status-processing'],
                        'failed'     => ['label'=>'Gagal', 'class'=>'status-failed'],
                    ];
                    $s = $statusMap[$rekon->status] ?? ['label'=>strtoupper($rekon->status),'class'=>'status-draft'];
                @endphp
                <span class="status-pill {{ $s['class'] }}">{{ $s['label'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="label">Tanggal Proses</td><td class="sep">:</td>
            <td class="value">{{ $rekon->created_at->format('d M Y, H:i') }}</td>
            <td class="label">Dibuat Oleh</td><td class="sep">:</td>
            <td class="value">{{ $rekon->user->name ?? '-' }}</td>
        </tr>
        @if($rekon->status === 'completed')
        <tr>
            <td class="label">Disetujui Oleh</td><td class="sep">:</td>
            <td class="value">{{ $rekon->approvedBy->name ?? '-' }}</td>
            <td class="label">Tanggal Approve</td><td class="sep">:</td>
            <td class="value">{{ optional($rekon->approved_at)->format('d M Y, H:i') ?? '-' }}</td>
        </tr>
        @endif
    </table>

    <div class="section-title">Ringkasan Hasil Rekonsiliasi</div>
    <table class="summary">
        <tr>
            <td><span class="num num-total">{{ number_format($total) }}</span><span class="lbl">Total Item</span></td>
            <td><span class="num num-match">{{ number_format($matched) }}</span><span class="lbl">Match</span></td>
            <td><span class="num num-mismatch">{{ number_format($mismatch) }}</span><span class="lbl">Mismatch</span></td>
            <td><span class="num num-sap">{{ number_format($sapOnly) }}</span><span class="lbl">SAP Only</span></td>
            <td><span class="num num-icrm">{{ number_format($icrmOnly) }}</span><span class="lbl">ICRM Only</span></td>
        </tr>
    </table>

    <div class="section-title">Detail Hasil Pencocokan ({{ number_format($total) }} item)</div>
    <table class="detail">
        <thead>
            <tr>
                <th style="width:4%;">#</th>
                <th style="width:14%;">Serial Number</th>
                <th style="width:8%;">Status</th>
                <th style="width:18%;">Keterangan</th>
                <th style="width:16%;">Material SAP</th>
                <th style="width:16%;">Material ICRM+</th>
                <th style="width:12%;">Mitra ICRM+</th>
                <th style="width:12%;">Petugas ICRM+</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $i => $row)
                @php
                    $dbSt = $row->status ?? 'mismatch';
                    if ($dbSt === 'match') {
                        $displayStatus = 'match'; $keterangan = 'Serial Number & Material cocok';
                    } elseif (!empty($row->sap_material) && !empty($row->icrm_material)) {
                        $displayStatus = 'mismatch_diff'; $keterangan = 'Serial Number sama, Material berbeda';
                    } elseif (!empty($row->sap_material) && empty($row->icrm_material)) {
                        $displayStatus = 'sap_only'; $keterangan = 'Data hanya ada di SAP';
                    } else {
                        $displayStatus = 'icrm_only'; $keterangan = 'Data hanya ada di ICRM+';
                    }
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row->serial_number }}</td>
                    <td>
                        @if($displayStatus === 'match')
                            <span class="badge badge-match">MATCH</span>
                        @else
                            <span class="badge badge-mismatch">MISMATCH</span>
                        @endif
                    </td>
                    <td>{{ $keterangan }}</td>
                    <td>{{ $row->sap_material ?? '-' }}</td>
                    <td>{{ $row->icrm_material ?? '-' }}</td>
                    <td>{{ $row->icrm_mitra ?? '-' }}</td>
                    <td>{{ $row->icrm_petugas ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-wrap">
        <table class="signature">
            <tr>
                <td>
                    Dibuat Oleh,
                    <div class="signature-space"></div>
                    <div class="signature-line">{{ $rekon->user->name ?? '-' }}</div>
                </td>
                <td>
                    Disetujui Oleh (Manager),
                    <div class="signature-space"></div>
                    <div class="signature-line">{{ $rekon->approvedBy->name ?? '........................' }}</div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>