<?php

namespace App\BaseRepository\Filters;

class ListFilter
{
    private $class;
    private string $key = "";
    private $value;
    protected Array $filters;

    public function __construct($class, String $key)
    {
        $this->class = $class;
        $this->key = $key;
    }

    public function getclass() {
        return $this->class;
    }

    public function getkey() {
        return $this->key;
    }

    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    public function setFilters(Array $filters) {
        $this->filtersRequest = $filters;

        return $this;
    }

    public function execute(&$instance) {
        (new $this->class($instance))->setFilters($this->filtersRequest)->execute($this->key, $this->value);
    }
}
