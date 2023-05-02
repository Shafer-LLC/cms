<?php

namespace Dply\CMS\Traits\Criterias;

/**
 * @property array $searchableFields
 */
trait UseSearchCriteria
{
    public function getFieldSearchable(): array
    {
        return $this->searchableFields;
    }
}
