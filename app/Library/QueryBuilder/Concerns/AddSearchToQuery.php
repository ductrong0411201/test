<?php

namespace App\Library\QueryBuilder\Concerns;

trait AddSearchToQuery
{
    public function allowedSearch($fields): self
    {
        if (empty($this->request->search()) || count($fields) < 1) {
            return $this;
        }

        $this->addFunctionToCallWhenGet(function () use ($fields) {
            $this->addSearchValueToQuery($fields, $this->request->search());
        });

        return $this;
    }

    protected function addSearchValueToQuery($fields, $value)
    {
        $modelTableName = $this->getModel()->getTable();
        $prependedFields = $this->prependFieldsWithTableName(collect($fields), $modelTableName);
        $this->where(function ($q) use ($prependedFields, $value) {
            $prependedFields->each(function ($field) use ($q, $value) {
                $value = str_replace(["%", "_", "^"], ["\%", "\_", "\^"], $value);
                $q->orWhere($field, 'ilike', '%' . $value . '%');
            });
        });
    }
}
