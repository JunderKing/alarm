<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class AlarmController extends Controller
{
    public function sendAlarm() {
        $title = $this->param('title', 'nullable|string', '通知');
        $content = $this->check('content', 'required|string');
        Models\Alarm::send($title, $content);

        return $this->output();
    }
}
