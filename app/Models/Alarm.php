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
        $pusher->setPlatform('all');
        // audience
//         $pusher->addAllAudience();
        $pusher->addRegistrationId('1a0018970a03ed9d6b3');
        $pusher->addRegistrationId('18071adc03a596b211b');
        $pusher->addRegistrationId('13065ffa4ea54ea92ea');
        $pusher->addRegistrationId('160a3797c8d3c0cd462');
        // notification
        $pusher->androidNotification($content, [
            'title' => $title,
            'style' => 1,
            'big_text' => $content,
        ]);
        $pusher->iosNotification(['title' => $title, 'body' => $content], [
            'sound' => 'default',
            'badge' => '+1',
        ]);
        $pusher->options(['apns_production' => false]);
        // 推送
        $pusher->send();
    }
}
