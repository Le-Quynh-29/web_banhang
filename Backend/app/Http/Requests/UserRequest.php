<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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
            'username' => ['required', Rule::unique('users')->ignore($this->user),'max:20','regex:/^[A-Za-z0-9\-_@]+$/'],
            'fullname' => 'required|max:50',
            'email' => ['required',Rule::unique('users')->ignore($this->user),'email','max:255'],
            'phone_number' => ['required','min:8','max:255',
                'regex:/^[+0(]?\(?([0-9]{1,5})\)?[-. ]?\(?([0-9]{1,5})\)?[-. ]?\(?([0-9]{1,5})\)?[-. ]?\(?([0-9]{1,5})\)?[-. ]?\(?([0-9]{1,5})\)?$/'],
            'password' => 'required|min:8|max:20|regex:/^(?:\+?\d{1,3}\s?)?[0-9\-]+$/',
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
            'username.required' => ':attribute không được để trống.',
            'username.unique' => ':attribute đã tồn tại.',
            'username.min' => ':attribute lớn hơn hoặc bằng :min ký tự.',
            'username.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',
            'username.regex' => ':attribute chứa ký tự đặc biệt không được phép.',

            'fullname.required' => ':attribute không được để trống.',
            'fullname.max' => ':attribute phải nhỏ hơn hoặc bằng :max ký tự.',

            'email.email' => ':attribute phải nhỏ hơn hoặc bằng :max ký tự.',
            'email.unique' => ':attribute đã tồn tại.',
            'email.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',

            'phone_number.required' => ':attribute không được để trống.',
            'phone_number.min' => ':attribute lớn hơn hoặc bằng :min ký tự.',
            'phone_number.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',
            'phone_number.regex' => ':attribute không tồn tại.',

            'password.required' => ':attribute không được để trống.',
            'password.min' => ':attribute lớn hơn hoặc bằng :min ký tự.',
            'password.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',
            'password.regex' => ':attribute không được chứa ký tự tiếng Việt và dấu cách.',
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
            'username' => 'Tên đăng nhập',
            'fullname' => 'Họ và tên',
            'email' => 'Email',
            'phone_number' => 'Số điện thoại',
            'password' => 'Mật khẩu',
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
