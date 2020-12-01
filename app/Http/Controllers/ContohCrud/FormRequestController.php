<?php

namespace App\Http\Controllers\ContohCrud;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequestController extends FormRequest
{
    /**class ini digunakan untuk menghilangkan validator dan menghandle secara langsung di request */
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
        $method = $this->method();
        if ($method == "POST") {
            return $this->createRules();
        } elseif ($method == "PUT") {
            return $this->updateRules();
        }
    }

    /**
     * Create rules
     *
     * @return rules
     */
    public function createRules()
    {
        $rules = [
            'name'        => 'required',
            'description' => 'required'
        ];
        return $rules;
    }

    /**
     * Updated rules
     *
     * @return rules
     */
    public function updateRules()
    {
        $rules = [
            'name'        => 'required',
            'description' => 'required',
            'id'          => 'required'
        ];
        return $rules;
    }

    /**
     * Message for validation
     *
     * @return messages
     */
    public function messages()
    {
        $messages = [
            'required' => ':attribute harus diisi',
        ];
        return $messages;
    }

    /**
     * Attributes field
     *
     * @return attrributes
     */
    public function attributes()
    {
        $attributes = [
            'name' => 'Nama',
            'description' => 'Deskripsi'
        ];
        return $attributes;
    }

    /**
     * Validation failed
     *
     * @return json
     */
    protected function failedValidation(Validator $validator)
    {
        $message =  "Error Validation " . $this->route('id');
        $warning = Helper::parsingAlert($validator->errors()->all());
        $response = app('App\Http\Controllers\Controller')->resError($message, $warning);
        // throw new HttpResponseException(response()->json($response, 200)); //versi ajax
        throw new HttpResponseException(
            back()->withInput()->with('warning', $warning)
        );
    }
}
