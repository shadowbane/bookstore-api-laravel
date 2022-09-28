<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('books', 'title')
                    ->ignore($this->id)
                    ->where('author', $this->author)
                    ->where('edition', $this->edition),
            ],
            'author' => [
                'required',
                'string',
                Rule::unique('books', 'author')
                    ->ignore($this->id)
                    ->where('title', $this->title)
                    ->where('edition', $this->edition),
            ],
            'edition' => [
                'required',
                'numeric',
                Rule::unique('books', 'edition')
                    ->ignore($this->id)
                    ->where('author', $this->author)
                    ->where('title', $this->title),
            ],
        ];
    }
}
