<?php

namespace App\BaseRepository\Crud;

use App\BaseRepository\Enum\EOperation;

trait TUpdate {

    public function update()
    {
        try {
            $this->beforeExecute(EOperation::UPDATE);

            $this->data->fill($this->request);
            $this->data->save();

            $this->afterExecute(EOperation::UPDATE);

            return $this->data->refresh();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function upsert($keys)
    {
        try {
            $this->modelClass::upsert($this->request, $keys);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}