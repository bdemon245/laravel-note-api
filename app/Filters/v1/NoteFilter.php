<?php

namespace App\Filters\v1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;


class NoteFilter extends ApiFilter
{
    protected $allowedParams = [
        'title' => ['eq', 'like'],
        'content' => ['eq', 'like'],
        'createdAt' => ['eq', 'gt', 'lt', 'gte', 'lte', 'ne'],
    ];
}
