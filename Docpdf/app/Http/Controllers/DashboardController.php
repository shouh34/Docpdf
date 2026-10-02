<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Documents;
use Exception;
use App\Models\User;

class DashboardController extends Controller
{
   public function index()
   {
    $user = Auth::user();

    $recentDocuments = Documents::where('user_id', $user->id)
        ->latest('created_at')
        ->paginate(5);

    $documentCount = Documents::where('user_id', $user->id)->count();

    $monthlyDocumentCount = Documents::where('user_id', $user->id)
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    $notifications = $user->unreadNotifications()
        ->latest()
        ->get();
$user = Auth::user();

$endingSoonDocuments = Documents::where('user_id', $user->id)
    ->whereDate('end_date', '>=', today())
    ->whereDate('end_date', '<=', today()->addDays(30))
    ->orderBy('end_date')
    ->limit(5)
    ->get();

    return view('Dashboard.dashboard', compact(
        'recentDocuments',
        'documentCount',
        'monthlyDocumentCount',
        'notifications',
        'endingSoonDocuments'
    ));

}


}
