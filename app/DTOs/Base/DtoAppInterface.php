<?php
namespace App\DTOs\Base;

interface DtoAppInterface
{
    public static function transformStoreRequest(): self;
    public static function transformUpdateRequest(): self;
}