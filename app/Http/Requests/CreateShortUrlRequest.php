<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateShortUrlRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required|url',
            'expiration' => 'int|max:3',
            'customUrlName' => 'string|unique:urls,short_url'
        ];
    }

    protected function failedValidation(Validator $validator){
      throw new HttpResponseException(
        response()->json(
          ['success' => false,
            'errors' => $validator->errors()->first(),
          ],409
        )
      );
    }
}
