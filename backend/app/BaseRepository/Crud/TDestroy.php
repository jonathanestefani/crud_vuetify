<?php

namespace App\BaseRepository\Crud;

use DateTime;

trait TDestroy {

    public function destroy()
    {
        try {
            $this->data->deleted_at = new DateTime('now');
            $this->data->save();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}