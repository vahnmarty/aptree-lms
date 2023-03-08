<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class AiController extends Controller
{
    public function chatgpt()
    {
        $file = public_path('gpt.log');

        $array = explode("\n", file_get_contents('gpt.log'));

        dd($array);

        $json = json_encode($file);

        $decode = json_decode($json);

        return $decode;

        return $json;
    }
}
