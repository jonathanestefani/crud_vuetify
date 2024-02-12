<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorServiceException;
use App\Services\Car\SimulateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class SimulateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['simulate']]);
    }

    public function simulate(Request $request)
    {
        try {
            $simulate = (new SimulateService())->setRequest($request);

            $six = $simulate->execute(6, $request->total) / 6;
            $twelve = $simulate->execute(12, $request->total) / 12;
            $forty_eight = $simulate->execute(48, $request->total) / 48;

            return response()->json(["six" => $six, "twelve" => $twelve, "forty_eight" => $forty_eight]);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(["message" => "Ocorreu um erro ao tentar calcular!"], 500);
        }
    }
}
