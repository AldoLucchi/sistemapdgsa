<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Notifications\GeneralNotification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class NotificationService
{
    public function setNotification($data)
    {
        Log::info('NotificationService - setNotification');
        Log::info($data);

        try {
            $user = User::find($data['user_id']);

            if ($user) {
                Notification::Send($user, new GeneralNotification($data));

                return true;
            }
            return false;
        } catch (Exception $e) {
            Log::info('NotificationService - setNotification - error - ' . $e->getMessage());
            return false;
        }
    }

    public function getNotificationsByUser()
    {
        $user = Auth::user();

        $data = [];
        $notifications = $user->notifications;
        $data['cantidad'] = $notifications->count();
        $notificacionesNoLeidas = [];
        $notificacionesLeidas = [];

        foreach ($notifications as $notification) {
            if ($notification->read_at) {
                $notificacionesLeidas[] = $notification;
            } else {
                $notificacionesNoLeidas[] = $notification;
            }
        }

        $data['leidas'] = $notificacionesLeidas;
        $data['noleidas'] = $notificacionesNoLeidas;
        
        return $data;
    }

    public function setNotificationRead($id){
        $notification = auth()->user()->unreadNotifications->where('id', $id)->first();
        $notification->markAsRead();

        return $notification;
    }
}
