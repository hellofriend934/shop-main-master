<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ThumbnailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function __invoke(string $dir, string $method, string $size, string $file):BinaryFileResponse
    {
        //
//        dd(config('thumbnail.allowed_sizes'));
        abort_if(!in_array($size, config('thumbnail.allowed_sizes',[])),
            403, 'size not avaliable'
        );

        $storage = Storage::disk('images');
        $realPath = "$dir/$file";
        $newDirPath = "$dir/$method/$size";
        $resultPath = "$newDirPath/$file";

        if (!$storage->exists($newDirPath)){
            $storage->makeDirectory($newDirPath);
        }

        if (!$storage->exists($resultPath)){
            $image = Image::make($storage->path($realPath));
            [$w, $h] = explode('x',$size);
            $image->{$method}($w,$h);
            $image->save($storage->path($resultPath));
        }
        return  response()->file($storage->path($resultPath));
    }
    //todo протестировать этот контроллер
}
