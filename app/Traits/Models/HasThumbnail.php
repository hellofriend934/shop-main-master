<?php
declare(strict_types=1);

namespace App\Traits\Models;

trait HasThumbnail
{
    abstract protected function thumbnailDir():string;

public function makeThumbnail(string $size, string $method = 'resize')
{
    return route('thumbnail',['size'=>$size, 'dir'=>$this->thumbnailDir(), 'method'=>$method, 'file'=>\Illuminate\Support\Facades\File::basename($this->{$this->thumbnailColumn()})]);
}

protected function thumbnailColumn()
{
return 'thumbnail';
}
}
