<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteScriptSetting extends Model
{
    protected $fillable = [
        'setting_key',
        'header_scripts',
        'footer_scripts',
    ];
}

