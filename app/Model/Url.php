<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['url','shortened'];

    //生成短链
    public static function getUnqiueShortUrl()
    {
        $shortened = base_convert(rand(10000, 99999), 10, 36);

        // 验证唯一性
        $record = Url::where('shortened', '=', $shortened)->first();

        if ($record) {
            self::getUnqiueShortUrl();
        }

        return $shortened;
    }
}
