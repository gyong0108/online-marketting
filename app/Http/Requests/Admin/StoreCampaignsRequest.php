<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignsRequest extends FormRequest
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
            'name' => 'required',
            'daily_budget' => 'max:2147483647|required|numeric',
            'title' => 'min:20|max:30|required',
            'undertitle' => 'min:20|max:30|required',
            'shortdescription' => 'min:60|max:80|required',
            'description' => 'min:140|max:160|required',
            'logo' => 'nullable|mimes:png,jpg,jpeg,gif',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif',
            'email' => 'email',
        ];
    }
}
