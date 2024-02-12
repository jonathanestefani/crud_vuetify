<?php

namespace App\Helpers;

class GeneralFunctions
{
    /**
     * GenerateRandomString
     * original function: https://stackoverflow.com/questions/4356289/php-random-string-generator
     *
     * @param integer $length
     * @return String
     */
    public static function generateRandomString($length = 10): String
    {
        $scrambledAlphaCharacteres = '01DEFG234567~89abcdefgh.ijklqrstuvwx,yzABCHIJK56LMNOPQRST;UVWmnopXYZ^';
        $charactersLength = strlen($scrambledAlphaCharacteres);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $scrambledAlphaCharacteres[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public static function isBase64(String $base64): Bool
    {
        $base64Pattern = 'base64,';

        $result = (bool) strpos($base64, $base64Pattern);

        return $result;
    }

    public static function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
