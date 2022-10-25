<?php

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

function get_class_type($object)
{
          $class = get_class($object);
          $map = array_flip(Relation::morphMap());
          // return issetOrNull($map[$class]) ?? $class;
}
function get_class_name($class)
{
          $class_name = explode("\\", $class);
          $class = end($class_name);
          return strtolower($class);
}
function store_file($file)
{
          $mimetype = $file->getClientOriginalExtension();
          $path = $file->storeAs(
                    'files',
                    uniqid() . '.' . $mimetype,
                    'public'
          );
          return $path;
}
