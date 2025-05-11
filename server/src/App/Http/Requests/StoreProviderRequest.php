<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\ArticleLayout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProviderRequest extends FormRequest
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
     * @return array<string, array<mixed>|string|ValidationRule>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'color' => 'required|hex_color',
            'logoImage' => 'required|active_url',
            'aggregateUrl' => 'required|active_url',
            'hasProducts' => 'required|boolean',
            'layout' => ['required', Rule::enum(ArticleLayout::class)],
            'isActive' => 'required|boolean',
            'articleSelectorWrapper' => 'required',
            'articleSelectorHeadline' => 'required_if:articleHeadline,null',
            'articleHeadline' => 'required_if:articleSelectorHeadline,null',
            'articleSelectorSubHeadline' => 'nullable',
            'articleSelectorDescription' => 'nullable',
            'articleSelectorImage' => 'exclude_unless:articleImage,null',
            'articleImage' => 'exclude_unless:articleSelectorImage,null|active_url',
            'articleSelectorDate' => 'required',
            'articleSelectorDateLocale' => 'required',
            'articleSelectorDateFormat' => 'required',
            'articleSelectorLink' => 'exclude_unless:articleLink,null',
            'articleLink' => 'exclude_unless:articleSelectorLink,null|active_url',
            'productSelectorWrapper' => 'required_if_accepted:hasProducts',
            'productSelectorName' => 'required_if_accepted:hasProducts',
            'productSelectorImage' => 'required_if_accepted:hasProducts',
            'productSelectorLink' => 'required_if_accepted:hasProducts',
        ];
    }
}
