<?php

namespace App\Http\Requests\Goods;

use App\Http\Requests\BaseFormRequest;
use App\Models\Category;

class UpdateGoodsRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'categories' => 'sometimes|required|array|distinct|min:2|max:10',
            'categories.*' => 'sometimes|required|exists:' . Category::class . ',id',
            'is_published' => 'sometimes|required|boolean',
        ];
    }
}
