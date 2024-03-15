<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
    
        $notifications = Notification::where('user_id', $user->id)
        ->orderBy('date', 'desc')
        ->get()
        ->groupBy(function($notification) {
            return date('m/d/Y', strtotime($notification->date));
        });
    
        $formattedNotifications = [];
        foreach ($notifications as $date => $groupedNotifications) {
            $formattedNotifications[] = [
                'date' => $date,
                'notifications' => $groupedNotifications->toArray(),
            ];
        }
    
        return response()->json(['notifications' => $formattedNotifications]);
    }
}
