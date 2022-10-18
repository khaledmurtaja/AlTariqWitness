<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRawVideoTagsRequest extends FormRequest
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
            'tags.*.tag' => 'required',
            'tags.*.raw_video_id' => 'required|exists:raw_videos,id',
            'tags.*.start_at' => 'required',
            'tags.*.end_at' => 'required',
        ];
    }
}
