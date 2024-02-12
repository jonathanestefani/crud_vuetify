<?php

namespace App\BaseRepository\Abs;

abstract class ARepository
{
    protected $modelClass;
    protected $instance;
    protected $data = null;

    public function __construct($model)
    {
        $this->setModel($model);

        return $this;
    }

    public function setModel($model) {
        $this->modelClass = $model;
        $this->instance = $model::query();
    }

    // ENUM EMethodTypeAtCall
    protected function beforeExecute(String $method_type_at_call) {}
    protected function afterExecute(String $method_type_at_call) {}
}
