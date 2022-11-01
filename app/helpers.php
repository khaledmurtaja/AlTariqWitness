<?php

use App\Exceptions\FileNotFoundException;
use Illuminate\Database\Eloquent\Relations\Relation;
use Stevebauman\Location\Facades\Location;


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
function handle_video_upload($class)
{
          $class->user_id = auth()->user()->id;
          $file = request('file');
          if (!$file)
                    throw new FileNotFoundException();
          $class->ip_address = request('ip_address');
          $class->url =  store_file($file);
          $thumbnail = request('thumbnail');
          $currentUserInfo = Location::get($class->ip_address);
          $class->country = $currentUserInfo->countryName ?? 'undefined';
          $class->city = $currentUserInfo->cityName ?? 'undefined';
          $class->region = $currentUserInfo->regionName ?? 'undefined';
          if ($thumbnail)
                    $class->thumbnail = store_file($thumbnail);
          return $class;
}
