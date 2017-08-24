<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() //用于验证类似于“这篇文章是你的你可以修改，不是你的你就不能修改”
    {
        //return false;
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
            'name' => 'required|min:2|max:50',
            'category_id' => 'required|integer',
            'sort' => 'required|integer',
            'status' => 'required|integer',
            'price' => 'required|numeric',
            'content' => 'required',
        ];
    }
}
