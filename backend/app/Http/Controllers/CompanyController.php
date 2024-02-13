<?php

namespace App\Http\Controllers;

use App\BaseRepository\Services\ListAllService;
use App\Models\Company;
use App\Services\Company\ListIndexService;
use App\Services\Company\LoadService;
use App\Services\Company\DestroyService;
use App\Services\Company\StoreService;
use App\Exceptions\ErrorServiceException;
use App\Services\Company\Validator\ValidatorService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'update', 'store', 'destroy']]);
    }

    public function index(Request $request)
    {
        try {
            if ($request->all == true) 
                $data = (new ListAllService(Company::class))->setRequest($request)->execute();
            else 
                $data = (new ListIndexService(Company::class))->setRequest($request)->execute();

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
                "codigo" => $id
            ]);

            $data = (new LoadService(Company::class))->setRequest($params)->execute();
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

            $data = (new StoreService(Company::class))->setRequest($request)->execute();
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

            $data = (new StoreService(Company::class))->setRequest($request)->execute();
            return new Response($data);            
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(["message" => "Ocorreu um erro ao atualizar os dados do banco"], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = (new DestroyService(Company::class))->setId($id)->execute();
            return new Response($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao deletar os dados!'], 500);
        }
    }
}
