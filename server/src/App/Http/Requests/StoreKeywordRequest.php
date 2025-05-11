<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Domains\Article\Entities\Keyword;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreKeywordRequest extends FormRequest
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
            'word' => 'required|max:255',
        ];
    }

    public function convert(): Keyword
    {
        $data = $this->validated();

        return Keyword::fromString($data['word']);
    }
}
