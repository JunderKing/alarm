<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use JPush\Client as JPush;


class Alarm extends Model
{
    public static function send($title, $content) {
        $appKey = 'cc326eb4dd33aa0f393dde00';
        $masterSecret = '5bef70ea095cb1d123b0762b';
        $logPath = base_path() . '/storage/logs/jpush.log';
        // 初始化
        $client = new JPush($appKey, $masterSecret, $logPath);
        $pusher = $client->push();
        // platform
        $pusher->setPlatform('ios');
        // audience
        $pusher->addAllAudience();
        // notification
        $pusher->iosNotification(['title' => $title, 'body' => $content], [
            'sound' => 'default',
            'badge' => '+1',
        ]);
        $pusher->options(['apns_production' => false]);
        // 推送
        $pusher->send();
    }
}