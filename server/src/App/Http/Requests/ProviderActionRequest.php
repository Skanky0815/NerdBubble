<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderActionRequest extends FormRequest
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
     * @return array<string, array<mixed>|\Illuminate\Contracts\Validation\ValidationRule|string>
     */
    public function rules(): array
    {
        return [
            'action' => 'required',
            'data.aggregateUrl' => 'required_if:action,TEST_SELECTORS|active_url',
            'data.articleSelector.wrapper' => 'required_if:action,TEST_SELECTORS',
            'data.articleSelector.headline' => 'nullable',
            'data.articleSelector.subHeadline' => 'nullable',
            'data.articleSelector.description' => 'nullable',
            'data.articleSelector.image' => 'nullable',
            'data.articleSelector.dateSelector.date' => 'required_if:action,TEST_SELECTORS',
            'data.articleSelector.dateSelector.format' => 'required_if:action,TEST_SELECTORS',
            'data.articleSelector.dateSelector.locale' => 'nullable',
            'data.articleSelector.dateSelector.attribute' => 'nullable',
            'data.articleSelector.link' => 'nullable',
            'data.productSelector.wrapper' => 'nullable',
            'data.productSelector.name' => 'nullable',
            'data.productSelector.image' => 'nullable',
            'data.productSelector.link' => 'nullable',
        ];
    }
}
