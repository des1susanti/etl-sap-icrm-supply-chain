<?php
namespace App\Http\Controllers;

use App\Models\Reconciliation;
use App\Models\UploadLog;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_reconciliations' => Reconciliation::count(),
            'completed'             => Reconciliation::where('status', 'completed')->count(),
            'pending'               => Reconciliation::whereIn('status', ['draft', 'processing'])->count(),
            'total_users'           => User::count(),
            'recent_uploads'        => UploadLog::with('user')->latest()->take(5)->get(),
            'recent_reconciliations'=> Reconciliation::with('user')->latest()->take(5)->get(),
        ];

        // Chart data — rekonsiliasi per bulan (6 bulan terakhir)
        $chartData = Reconciliation::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->get();

        return view('dashboard.index', compact('stats', 'chartData'));
    }
}