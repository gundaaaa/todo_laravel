<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SinupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $this->pathでsinup以外のパスで利用できないようにしている。
        if ($this->path() == 'sinup') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'msg' => 'required',
            'mmm' => 'required',
        ];
    }
    // messagesにしないと日本語のエラーが出ない
    public function messages()
    {
        return[
            'msg.required' =>'ニックネームを入力してください。',
            'mmm.required' =>'内容の入力をしてください。',
        ];
    }
}
