<?php
class AboutModel extends Model
{
    public function __construct()
    {
        $this->storage = [
            'title' => 'О нас',
            'text' => 'Это страница о нас.'
        ];
    }
}