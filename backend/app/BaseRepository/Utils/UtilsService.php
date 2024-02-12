<?php

namespace App\BaseRepository\Utils;

use App\Exceptions\ErrorServiceException;

class UtilsService {

    public static function getAddressApi($api_name) {
        $arr_api_names = config('api_gateway.api_names');

        if ($arr_api_names[$api_name]) {
            return $arr_api_names[$api_name];
        }

        throw new ErrorServiceException('Recurso não identificado, favor verificar com o administrador!');
    }
}