<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueProduct implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $productIds = collect($value)->pluck('product_id');
        $uniqueProductIds = $productIds->unique();
        return $productIds->count() === $uniqueProductIds->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The product list contains duplicate product ids.';
    }
}
