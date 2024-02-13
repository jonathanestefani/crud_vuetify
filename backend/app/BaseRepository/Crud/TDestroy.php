<?php

namespace App\BaseRepository\Crud;

use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;

trait TDestroy {

    public function destroy()
    {
        try {
            if (in_array(SoftDeletes::class, class_uses_recursive($this->modelClass))) {
                $this->data->deleted_at = new DateTime('now');
                $this->data->save();
            } else {
                $this->data->delete();
            }
            
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}