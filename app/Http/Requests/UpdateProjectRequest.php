<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('projects')->ignore($this->route('project'))->where(function ($query) {
                    return $query->where('user_id', $this->user()->id);
                })
            ],
            'thumbnail' => 'image|dimensions:min_width=260,min_height=90|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '项目名称是必填的',
            'name.unique' => '项目名称必须是唯一的',
            'thumbnail.image' => '请上传一个图片文件',
            'thumbnail.dimensions' => '图片的最小尺寸是260X100像素',
            'thumbnail.max' => '图片的大小不能超过2M',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $this->errorBag = 'update-' . $this->route('project');
        parent::failedValidation($validator);
    }
}
