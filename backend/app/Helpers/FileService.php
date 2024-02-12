<?php

namespace App\Helpers\File;

use App\Helpers\GeneralFunctions;
use App\Models\UploadFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\ErrorFileServiceException;
use Str;

class FileService
{
    protected array $file;
    protected string $driver;
    protected $disk;
    protected $path_files = "app" . DIRECTORY_SEPARATOR . "files";

    public function __construct($driver = 'local')
    {
        $this->driver = $driver;
        $this->setPath('');
    }

    protected function defPath()
    {
        $this->disk = Storage::build([
            'driver' => $this->driver,
            'root' => $this->path_files,
        ]);
    }

    protected function setPath($path)
    {
        $this->path_files = $path;
        $this->defPath();
    }

    protected function validations()
    {
        if (!isset($this->file['name'])) {
            throw new ErrorFileServiceException('Nome do arquivo não definido!');
        } 
        if (!isset($this->file['content'])) {
            throw new ErrorFileServiceException("Conteúdo do arquivo " . $this->file['name'] . " não encontrado!");
        }
        if (!GeneralFunctions::isBase64($this->file['content'])) {
            throw new ErrorFileServiceException("Conteúdo do arquivo " . $this->file['name'] . " deve estar encodado em formato base64");
        }
    }

    protected function persistFile(String $name_destination)
    {
        $this->prepareFile();

        try {
            $this->disk->put(
                    $this->path_files . DIRECTORY_SEPARATOR . $name_destination,
                    $this->file["file_binary"]
                );
            return $this->file;
        } catch (\Throwable $th) {
            Log::error($th);
            throw new ErrorFileServiceException("Houve um problema ao tentar salvar o arquivo " . $this->file['name'] . " no diretório, favor analisar com a equipe técnica da hapag!");
        }
    }

    protected function prepareFile()
    {
        try {
            $this->fileFromBase64($this->file['content']);
            $name_destination = Str::uuid() . "." . $this->file["file_extension"];
            $this->file["name_destination"] = $name_destination;
        } catch (\Throwable $th) {
            Log::error("FileService::prepareFile - " . $th->getMessage());
            throw new ErrorFileServiceException("Houve um problema ao tentar preparar o arquivo " . $this->file['name'] . " para salvar, favor analisar com a equipe técnica da hapag!");
        }
    }

    protected function fileFromBase64(String $base64)
    {
        $data = $base64;
        list($extension, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        list(, $extension) = explode('/', explode(':', $extension)[1]);
        $fileObj = base64_decode($data);
        $this->file["file_binary"] = $fileObj;
        $this->file["file_extension"] = $extension;
    }

    /**
     * @param String $table - Tabela responsável pelo arquivo
     * @param String $parent_id - Chave primária responsável pelo arquivo
     * @return String $file -  Estrutura {
     *                                      "content" => base64 do arquivo
     *                                      "name" => Nome do arquivo
     *                                    }
     */
    protected function saveFile(String $table, int $parent_id, $file)
    {
        $this->file = $file;
        $this->validations();

        $fileObj = $this->persistFile($table . DIRECTORY_SEPARATOR . $this->file["name_destination"]);

        try {
            $model = array();
            $model["table"] = $table;
            $model["parent_id"] = $parent_id;
            $model["file_name"] = $this->file["name"];
            $model["new_name"] = $fileObj["name_destination"];

            return $this->saveModel($model);
        } catch (\Throwable $th) {
            Log::error("FileService::saveFile - " . $th->getMessage());
            throw $th;
        }
    }

    protected function saveModel(array $fileModel)
    {
        $returnFileModel = UploadFile::create($fileModel);
        return $returnFileModel;
    }

    public function destroy(int $id)
    {
        try {
            $file = UploadFile::find($id);

            if ($file) {
                $file->delete();
                return true;
            } else {
                throw new ErrorFileServiceException('Arquivo não encontrado para download!');
            }
        } catch (\Throwable $th) {
            Log::error("FileService::saveFile - " . $th->getMessage());
            throw $th;
        }
    }

    protected function getPathDownload(int $id)
    {
        try {
            $file = UploadFile::find($id);

            if ($file) {
                return base_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $file->table . DIRECTORY_SEPARATOR . $file->new_name;
            } else {
                throw new ErrorFileServiceException('Arquivo não encontrado para download!');
            }
        } catch (\Throwable $th) {
            Log::error("FileService::saveFile - " . $th->getMessage());
            throw $th;
        }
    }
}