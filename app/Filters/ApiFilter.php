<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $allowedParams = [];
    protected $columnMap = [];

    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
        'like' => 'LIKE',
        'nl' => 'NOT LIKE',
        'in' => 'IN',
    ];


    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->allowedParams as $param => $operators) {
            $query = $request->query($param);
            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as  $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = $operator === 'like' ?
                        [$column, $this->operatorMap[$operator], "%" . $query[$operator] . "%"]
                        : [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
            return $eloQuery;
        }
    }
}
