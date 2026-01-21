<?php

namespace App\Http\Requests;

use App\Rules\FloatNumber;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:30',
            'description' => 'nullable|string|max:100',
            'duration'=>'integer|min:1|max:10',
            'price'=>['required','numeric',new FloatNumber()],
            'start_date'=>'required|date|after_or_equal:today',
            'end_date'=>'required|date|after:start_date',
            'volume'=>'required|image|mimes:jpeg,jpg|max:2000',

        ];
    }
}
