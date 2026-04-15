<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoPageSetting extends Model
{
    protected $fillable = [
        'page_key',
        'page_name',
        'meta_title',
        'meta_description',
        'schema_json',
    ];
}

