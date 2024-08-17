<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;


class NotificationController extends Controller
{

    private $notificationService;

    public function __construct(
        NotificationService $notificationService,
    ) {
        $this->notificationService = $notificationService;
    }

    public function setNotification(Request $request)
    {
        $result = $this->notificationService->setNotification($request->all());

        if ($result) {
            return response()->json([
                'message' => 'Success'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Error',
                'message' => 'Server Error'
            ], 500);
        }
    }

    public function notificationMarkRead($id)
    {
        $result = $this->notificationService->setNotificationRead($id);
        return $result;
    }
}
