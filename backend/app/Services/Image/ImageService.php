<?php

namespace App\Services\Image;

use App\Helpers\GeneralFunctions;
use App\Models\UploadFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\ErrorImageServiceException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Str;

class ImageService
{
    protected array $file;
    protected string $driver;
    protected $path_files = "files" . DIRECTORY_SEPARATOR;

    public function __construct($driver = 'local')
    {
        $this->driver = $driver;
    }

    private function validations()
    {
        if (!isset($this->file['name'])) {
            throw new ErrorImageServiceException('Nome do arquivo não definido!');
        }
        if (!isset($this->file['content'])) {
            throw new ErrorImageServiceException("Conteúdo do arquivo " . $this->file['name'] . " não encontrado!");
        }
        if (!GeneralFunctions::isBase64($this->file['content'])) {
            throw new ErrorImageServiceException("Conteúdo do arquivo " . $this->file['name'] . " deve estar encodado em formato base64");
        }
    }

    private function persistImage(String $table)
    {
        $this->prepareImage();

        try {
            Storage::disk($this->driver)
                ->put(
                    $this->path_files . $table . DIRECTORY_SEPARATOR . $this->file["name_destination"],
                    $this->file["image_binary"]
                );
            return $this->file;
        } catch (\Throwable $th) {
            Log::error($th);
            throw new ErrorImageServiceException("Houve um problema ao tentar salvar o arquivo " . $this->file['name'] . " no diretório, favor analisar com a equipe técnica da hapag!");
        }
    }

    private function prepareImage()
    {
        try {
            $content = isset($this->file['preview']) ? $this->file['preview'] : $this->file['content'];
            $this->imageFromBase64($content);

            $name_destination = Str::uuid() . "." . $this->file["image_extension"];
            $this->file["name_destination"] = $name_destination;
        } catch (\Throwable $th) {
            Log::error("ImageService::prepareImage - " . $th->getMessage());
            throw new ErrorImageServiceException("Houve um problema ao tentar preparar o arquivo " . $this->file['name'] . " para salvar, favor analisar com a equipe técnica da hapag!");
        }
    }

    public function imageFromBase64(String $base64)
    {
        $data = $base64;
        list($extension, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        list(, $extension) = explode('/', explode(':', $extension)[1]);
        $image = base64_decode($data);
        $this->file["image_binary"] = $image;
        $this->file["image_extension"] = $extension;
    }

    public function getImage(String $filename, String $table = "users"): Collection
    {
        $filepath = base_path() . DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "files" . DIRECTORY_SEPARATOR . $filename;

        if (!File::exists($filepath)) {
            abort(404);
        }

        $file = File::get($filepath);
        $type = File::mimeType($filepath);

        return collect([
            "content" => $file,
            "type" => $type
        ]);
    }
}
