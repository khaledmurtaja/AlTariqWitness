<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logs extends Model
{
    use HasFactory, SoftDeletes;
    protected $appends = ['action_type_name'];
    public function getActionTypeNameAttribute()
    {
        $types = [
            __("Uploaded"),
            __("Edited"),
            __("Extracted"),
            __("Cancelled"),
        ];
        return  $types[(int) $this->action_type] ?? '';
    }
}
