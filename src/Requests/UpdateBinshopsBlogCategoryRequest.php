<?php

namespace BinshopsBlog\Requests;

class UpdateBinshopsBlogCategoryRequest extends BaseBinshopsBlogCategoryRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $return = $this->baseCategoryRules();

        return $return;

    }
}
