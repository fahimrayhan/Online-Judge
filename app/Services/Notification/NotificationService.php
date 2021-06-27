<?php

namespace App\Services\Notification;

use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationSend;
use Illuminate\Support\Facades\Http;

class NotificationService
{
    public static function createNotification($data)
    {
        Notification::create($data);
        return response()->json(['message' => "Notification Added"]);
    }

    public function sendNotification()
    {
        $notifications = Notification::all();
        foreach ($notifications as $notification) {
            if ($notification->type == 'mail') {
                Mail::to($notification->to)
                    ->send(new NotificationSend($notification));
            } elseif ($notification->type == 'sms') {
                Http::asForm()->post(env('SMS_API'), [
                    'to' => $notification->to,
                    'message' => $notification->body,
                    'token' => env('SMS_TOKEN')
                ]);
            }
            $notification->delete();
        }
    }

    public  static function sendSMS($smsData)
    {
        $data['type'] = "sms";
        if (!isset($smsData['to'])) {
            return response()->json(['message' => "SMS Data need a to field"], 403);
        }
        if (!isset($smsData['message'])) {
            return response()->json(['message' => "SMS Data need a message field"], 403);
        }
        $data['to'] = $smsData['to'];
        $data['body'] = $smsData['message'];
        return self::createNotification($data);
    }

    public static function sendMail($mailData)
    {
        $data['type'] = "mail";
        if (!isset($mailData['to'])) {
            return response()->json(['message' => "Mail Data need a to field"], 403);
        }
        if (!isset($mailData['message'])) {
            return response()->json(['message' => "Mail Data need a message field"], 403);
        }
        if (!isset($mailData['subject'])) {
            return response()->json(['message' => "Mail Data need a subject field"], 403);
        }
        $data['to'] = $mailData['to'];
        $data['body'] = $mailData['message'];
        $data['subject'] = $mailData['subject'];
        $data['from_name'] = "CoderOJ";
        
        return self::createNotification($data);
    }
}
