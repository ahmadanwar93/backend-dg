<?php

namespace App\Rules;

use App\Enums\ProductCategoryEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductCategory implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail):void
    {
        $categories = explode(',', $value);

        foreach($categories as $category)
        {
            // do validation logic
            if(!in_array($category, ProductCategoryEnum::cases()))
            {
                $fail('The :attribute must be present in the categories.');
            }
        }
    }
}
