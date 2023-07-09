<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'option_values';

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
