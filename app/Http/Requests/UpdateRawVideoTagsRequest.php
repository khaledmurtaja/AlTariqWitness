<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRawVideoTagsRequest extends FormRequest
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
            'tag' => 'required',
            'raw_video_id' => 'required|exists:raw_videos,id',
            'start_at' => 'sometimes',
            'duration' => 'sometimes',
            'end_at' => 'sometimes',
        ];
    }
}
