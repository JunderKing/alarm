<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class AlarmSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alarm:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $title = 'TEST';
        $content = '2015年8月24日 - 极光推送是比较专业的一款推送工具,当然觉得极光推送有难度的开发者可以使用很多其他...上一篇[学习]安卓开发app实现自动更新version.xml正确的书写方...';
        Models\Alarm::send($title, $content);
    }
}
