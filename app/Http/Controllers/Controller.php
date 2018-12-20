<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $ruleList;

    public function param($name, $rule, $default = null, Array $dict = []) {
        $this->ruleList[$name] = $rule;
        $param = \Request::input($name, $default);
        $dict && $param = $dict[$param];
        return $param;
    }

    public function check($name, $rule, $default = null, $dict = []) {
        $this->ruleList[$name] = $rule;
        $validator = \Validator::make(\Request::all(), $this->ruleList);
        if ($validator->fails()) {
            $errmsg = env('APP_ENV') === 'local' ? $validator->errors()->all()[0] : '';
            throw new \Error($errmsg, 100);
        } else {
            $param = \Request::input($name, $default);
            $dict && $param = $dict[$param];
            return $param;
        }
    }

    public function output(Array $data = []) {
        $resData = config("error.0");
        $data && $resData['data'] = $data;

        return response()->json($resData)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function error($errcode = 101, $errmsg = '') {
        throw new \ErrOut($errmsg, $errcode);
    }
}
