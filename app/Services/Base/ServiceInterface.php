<?php
namespace App\Services\Base;

interface ServiceInterface {

    public function store($dto);
    public function update($model, $dto);
    public function delete($model);
}