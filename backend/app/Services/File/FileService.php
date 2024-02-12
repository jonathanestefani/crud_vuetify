<?php

namespace App\Services\File;

use App\Exceptions\ErrorServiceException;
use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FileService
{
    protected $file;
    protected string $file_name;
    protected string $new_name;
    protected SerializedFilename $serializedFilename;
    protected string $driver;
    protected Model $scope;

    public function __construct($driver = "local")
    {
        $this->driver = $driver;
    }

    public function setFile($file): FileService
    {
        $this->file = $file;

        return $this;
    }

    public function setFileName(string $file_name): FileService
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function setScope(Model $scope): FileService
    {
        $this->scope = $scope;

        return $this;
    }

    public function save(): UploadFile
    {
        $this->validate();

        $this->persist();

        return new UploadFile([
            "table" => $this->scope->getTable(),
            "new_name" => $this->new_name,
            "file_name" => $this->file_name,
        ]);
    }

    protected function validate()
    {
        if (!isset($this->file) || empty($this->file)) {
            throw new ErrorServiceException("Arquivo não definido");
        }

        if (!isset($this->file_name) || empty($this->file_name)) {
            throw new ErrorServiceException("Nome do arquivo não definido");
        }

        if (!isset($this->scope) || empty($this->scope)) {
            throw new ErrorServiceException("Escopo não definido");
        }
    }

    protected function persist()
    {
        try {
            $folder = $this->defineURL();

            $file = Storage::disk($this->driver)
                ->put($folder, $this->file);

            $this->defineNewName($file);
        } catch (\Throwable $th) {
            Log::error("FileService::persistImage" . $th);
            throw new ErrorServiceException("Houve um problema ao tentar salvar o arquivo " . $this->file_name);
        }
    }

    protected function defineNewName(string $file)
    {
        $folder = $this->defineURL();

        $new_name = str_replace($folder, '', $file);

        $this->new_name = $new_name;
    }

    protected function serializeFilename(): SerializedFilename
    {
        $splittedFilename = explode(".", $this->file_name);

        $extension = end($splittedFilename);

        $name = implode(".", explode(".", $this->file_name, -1));

        $this->serializedFilename = new SerializedFilename($name, $extension);

        return $this->serializedFilename;
    }

    protected function defineURL()
    {
        $tablename = $this->scope->getTable();

        $url = "files" . DIRECTORY_SEPARATOR . "$tablename";

        return $url;
    }

    public static function getURL(UploadFile $file)
    {
        $url = "app" . DIRECTORY_SEPARATOR . "files" . DIRECTORY_SEPARATOR . $file->table . DIRECTORY_SEPARATOR . $file->new_name;

        return storage_path($url);
    }
}
