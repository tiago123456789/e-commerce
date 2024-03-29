<?php


namespace App\Service;


interface Storage
{

    public function store($name, $content, $permissions = []): String;

    public function remove($name);
}