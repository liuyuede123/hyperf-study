<?php


namespace App\Util;

class Response
{
    public static function json(int $code, string $msg, $data = []): string
    {
        return json_encode(['code' => $code, 'msg' => $msg, 'data' => $data], JSON_UNESCAPED_UNICODE);
    }

    public static function array(int $code, string $msg, $data = []): array
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }

}