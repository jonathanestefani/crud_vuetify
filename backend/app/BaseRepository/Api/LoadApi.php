<?php

namespace App\BaseRepository\Api;

use App\BaseRepository\Exceptions\ErrorApiCallException;
use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;
use App\BaseRepository\Utils\UtilsService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class LoadApi
{
    private $api_name = "";
    private $key_local = "";
    private $value = "";
    private $alias = "";
    private $params = [];
    private $sub_resource = "";

    public function __construct($api_name, $key_local, $alias = "", $sub_resource = "")
    {
        $this->api_name = $api_name;
        $this->key_local = $key_local;
        $this->alias = !empty($alias) ? $alias : $api_name;
        $this->setSubResource($sub_resource);
    }

    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    public function getValue() {
        return $this->value;
    }

    public function setParams($params) {
        $this->params = $params;

        return $this;
    }

    public function setSubResource($sub_resource = "") {
        $this->sub_resource = $sub_resource;
    }

    public function getApi() {
        return $this->api_name;
    }

    public function getAlias() {
        return $this->alias;
    }

    public function getkeyLocal() {
        return $this->key_local;
    }

    public function loadRelation() {
        try {
            $address_api = UtilsService::getAddressApi($this->api_name) . '/api/';

            $this->params['microservices_secret'] = config('api_gateway.microservices_secret');

            $response = Http::get($address_api . $this->api_name . '/' . (!empty($this->sub_resource) ? $this->sub_resource . '/' : '') . $this->value, $this->params);

            if ($response->failed()) {
                throw new ErrorApiCallException('Não foi possível buscar os dados na api');
            } else {
                return json_decode($response->body());
            }
        } catch (ErrorApiCallException $th) {
            Log::error($th);

            throw $th;
        } catch (ErrorBaseRepositoryException $th) {
            Log::error($th);

            throw $th;
        } catch (\Throwable $th) {
            Log::error($th);

            throw $th;
        }
    }

    public function loadData() {
        try {
            $address_api = UtilsService::getAddressApi($this->api_name) . '/api/';

            $this->params['microservices_secret'] = config('api_gateway.microservices_secret');

            $response = Http::get($address_api . $this->api_name . '/' . (!empty($this->sub_resource) ? $this->sub_resource . '/' : '') . $this->value, $this->params);

            if ($response->failed()) {
                throw new ErrorApiCallException('Não foi possível buscar os dados na api');
            } else {
                return json_decode($response->body());    
            }
        } catch (ErrorApiCallException $th) {
            return new Response(["message" => $th->getMessage()], 404);
        } catch (ErrorBaseRepositoryException $th) {
            return new Response(["message" => $th->getMessage()], 404);
        } catch (\Throwable $th) {
            Log::error($th);

            return new Response(["message" => "Ocorreu um erro ao carregar os dados!"], 500);
        }
    }

}