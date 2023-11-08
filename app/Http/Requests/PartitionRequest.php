<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PartitionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        if ($request->isMethod('post')) {
            return [
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255|unique:partitions',
                'description' => 'nullable|string|max:255',
            ];
        } else {
            return [
                'category_id' => 'sometimes|exists:categories,id',
                'name' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
            ];
        }
    }
}
