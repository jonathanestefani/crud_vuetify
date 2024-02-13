<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\Customer\ListIndexService;
use App\Services\Customer\LoadService;
use App\Services\Customer\DestroyService;
use App\Services\Customer\StoreService;
use App\Exceptions\ErrorServiceException;
use App\Services\Customer\Validator\ValidatorService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'update', 'store', 'destroy']]);
    }

    public function index(Request $request)
    {
        try {
            $data = (new ListIndexService(Customer::class))->setRequest($request)->execute();
            
            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(["message" => "Ocorreu um erro ao carregar os dados!"], 500);
        }
    }

    public function show($id)
    {
        try {
            $params = new Request([
                "recnum" => $id
            ]);

            $data = (new LoadService(Customer::class))->setRequest($params)->execute();
            return new Response($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao carregar os dados!'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = new ValidatorService();

            if ($validator->execute($request)) {
                return new Response(["message" => $validator->getErrors()], 422);
            }

            $data = (new StoreService(Customer::class))->setRequest($request)->execute();
            return new Response($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao salvar os dados!'], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = new ValidatorService();

            if ($validator->execute($request)) {
                return new Response(["message" => $validator->getErrors()], 422);
            }

            $data = (new StoreService(Customer::class))->setRequest($request)->execute();
            return new Response($data);            
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(["message" => "Ocorreu um erro ao atualizar os dados do banco"], 500);
        }
    }

    public function destroy($empresa, $codigo)
    {
        try {
            $request = New Request([
                "empresa" => $empresa,
                "codigo" => $codigo
            ]);

            $data = (new DestroyService(Customer::class))->setRequest($request)->execute();
            return new Response($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao deletar os dados!'], 500);
        }
    }
}
