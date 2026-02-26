<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Edoc;
use Illuminate\Validation\Rule;


class BeviAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('edoc access');

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file_name' => [
                'required',
            ], 
            'title' => [
                'required',
            ], 
            'control_number' => [
                'required',
                // Rule::unique((new Edoc)->getTable())
                // ->where(function ($query) {
                //     return $query->where('status', 'active');
                // })
            ],
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        session()->flash('message_error', 'Error Uploading Edoc. File is required and must be a PDF file.');

        parent::failedValidation($validator);
    }
}
