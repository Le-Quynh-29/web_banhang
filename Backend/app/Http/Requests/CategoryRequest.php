<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('categories')->ignore($this->category),'max:255'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống.',
            'name.unique' => ':attribute đã tồn tại.',
            'name.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',
        ];
    }

    /**
     * attribute validate.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Tên danh mục',
        ];
    }

    /**
     * Fail validator
     *
     * @param  Validator $validator
     * @return HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE));
    }
}
