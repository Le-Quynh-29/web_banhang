<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'fullname' => 'required|max:50',
            'email' => ['required',Rule::unique('users')->ignore($this->user()->id, 'id'),'email','max:255'],
            'phone_number' => ['required','min:8','max:255',
                'regex:/^[+0(]?\(?([0-9]{1,5})\)?[-. ]?\(?([0-9]{1,5})\)?[-. ]?\(?([0-9]{1,5})\)?[-. ]?\(?([0-9]{1,5})\)?[-. ]?\(?([0-9]{1,5})\)?$/'],
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
            'fullname.required' => ':attribute không được để trống.',
            'fullname.max' => ':attribute phải nhỏ hơn hoặc bằng :max ký tự.',

            'email.email' => ':attribute phải nhỏ hơn hoặc bằng :max ký tự.',
            'email.unique' => ':attribute đã tồn tại.',
            'email.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',

            'phone_number.required' => ':attribute không được để trống.',
            'phone_number.min' => ':attribute lớn hơn hoặc bằng :min ký tự.',
            'phone_number.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',
            'phone_number.regex' => ':attribute không tồn tại.',
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
            'fullname' => 'Họ và tên',
            'email' => 'Email',
            'phone_number' => 'Số điện thoại',
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
