<?php
namespace App\DTOs\Base;

interface DtoApiInterface
{
    public static function transformStoreApiRequest(): self;
    public static function transformUpdateApiRequest(): self;
}