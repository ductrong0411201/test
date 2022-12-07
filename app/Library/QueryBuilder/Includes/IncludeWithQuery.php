<?php

namespace App\Library\QueryBuilder\Includes;

use App\Library\QueryBuilder\Includes\IncludeInterface;
use Illuminate\Database\Eloquent\Builder;

class IncludeWithQuery implements IncludeInterface
{
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function __invoke(Builder $query, string $include)
    {
        $callback = $this->callback;

        return $query->with([
            $include => $callback
        ]);
    }
}
