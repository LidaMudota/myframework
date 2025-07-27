<?php
class Model
{
    protected array $storage = [];

    public function data(): array
    {
        return $this->storage;
    }
}