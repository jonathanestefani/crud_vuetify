<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorServiceException;
use App\Services\Image\ImageService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['show']]);
    }

    public function show($filename)
    {
        try {
            $imageService = new ImageService();

            $file = $imageService->getImage($filename);

            $response = Response::make($file["content"], 200);
            $response->header("Content-Type", $file["type"]);
    
            return $response;
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error('FileController::show - ' . $th);
            throw $th;

            return new Response(["message" => "Ocorreu um erro desconhecido ao buscar os motivos de desconto"], 500);
        }
    }
}
