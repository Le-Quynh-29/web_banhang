<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        $validRoles = implode(',', [User::ROLE_ADMIN, User::ROLE_CUSTOMER]);
        $rules = [
            'username' => 'required|min:8|max:20|unique:users|regex:/^[A-Za-z0-9\-_@]+$/',
            'fullname' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'gender' => 'required',
            'phone_number' => 'required|min:8|max:20|regex:/^(?:\+?\d{1,3}\s?)?[0-9\-]+$/',
            'role' => 'required',
            'active' => 'required',
            'role' => 'required|in:' . $validRoles,
            'active' => 'required',
            'password' => 'required|min:6|max:20|regex:/^[^\s]+$/',
        ];
        return $rules;
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
            'username.regex' => ':attribute chỉ cho phếp các ký tự :value.',

            'fullname.required' => ':attribute không được để trống.',
            'fullname.max' => ':attribute phải nhỏ hơn hoặc bằng :max ký tự.',

            'email.required' => ':attribute không được để trống.',
            'email.email' => ':attribute phải nhỏ hơn hoặc bằng :max ký tự.',
            'email.unique' => ':attribute đã tồn tại.',
            'email.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',

            'gender.required' => ':attribute không được để trống.',

            'phone_number.required' => ':attribute không được để trống.',
            'phone_number.min' => ':attribute lớn hơn hoặc bằng :min ký tự.',
            'phone_number.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',
            'phone_number.regex' => ':attribute chỉ cho phếp các ký tự :value.',
            
            'role.required' => ':attribute không được để trống.',
            'role.in' => ':attribute không thuộc các quyền được cấp phép.',

            'active.required' => ':attribute không được để trống.',

            'password.required' => ':attribute không được để trống.',
            'password.min' => ':attribute lớn hơn hoặc bằng :min ký tự.',
            'password.max' => ':attribute nhỏ hơn hoặc bằng :max ký tự.',
            'password.regex' => ':attribute chỉ cho phếp các ký tự :value.',
        ];
    }
    public function attributes(): array
    {
        return [
            'username' => 'Tên đăng nhập',
            'fullname' => 'Tên của bạn',
            'password' => 'Mật khẩu',
            'email' => 'Email',
            'gender' => 'Giới tính',
            'phone_number' => 'Số điện thoại',
            'role' => 'Chức vụ',
            'active' => 'Trạng thái',
            'password' => 'Mật khẩu',
        ];
    }
}
