<?php

namespace App\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    public function render()
    {
        return response()->json(['message' => ('Please Add Video File')], 422);
    }
}
