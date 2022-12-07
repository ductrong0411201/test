<?php

namespace App\Library\QueryBuilder\Concerns;

trait AddPaginationToQuery
{
    public function allowedPagination()
    {
        $this->func_get = function () {
            $option = $this->request->pagination();
            if (!empty($option['is_paginate']) && $option['is_paginate'] != 'false') {
                return $this->addPaginationToQuery($option);
            }
            if (empty($option['limit']) || $option['limit'] === '-1' || $option['limit'] === 'all') {
                return $this->callAllAddToQuery()->__call('get', func_get_args());
            }
            $this->limit((int)$option['limit']);
            return $this->callAllAddToQuery()->__call('get', func_get_args());
        };
        return $this;
    }
    protected function addPaginationToQuery($option)
    {
        $page = $option['page'];
        $per_page = $option['per_page'];
        if ($option['is_paginate'] == 'simple') {
            return $this->simplePaginate($per_page, ['*'], 'page', $page);
        }
        return $this->paginate($per_page, ['*'], 'page', $page);
    }
}
