<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Auth;

class ArticleRequest extends FormRequest
{
    public function authorize()
    {
        // عدّل حسب من يملك الصلاحية، مؤقتاً نسمح للمستخدمين المسجلين
        return Auth::check();

    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'published' => 'sometimes|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('content')) {
            // تنظيف المحتوى عبر Purifier قبل التحقق والحفظ
            $this->merge([
                'content' => Purifier::clean($this->input('content'), 'default'),
            ]);
        }
    }
}
