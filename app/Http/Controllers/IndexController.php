<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortUrlsRequests;
use App\Model\Url;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function doGenerate(ShortUrlsRequests $requests)
    {
        $validate = $requests->validated();
        if ($validate) {
            $urls = $validate['url'];

            // 判断当前链接是否已经存在数据库中
            $record = Url::where('url', '=', $urls)->first();

            if ($record) {
                // 存在
                return view('home.result')->with(['shortened' => $record['shortened']]);
            } else {
                // 不存在
                $shortened = Url::getUnqiueShortUrl();
                $inserts = Url::create([
                    'url' => $urls,
                    'shortened' => $shortened
                ]);

                if ($inserts) {
                    return view('home.result')->with(['shortened' => $shortened]);
                }
            }
        }
    }


    public function shortenedLink($code)
    {
        $urls = Url::where('shortened', '=', $code)->first();

        if (!$urls) {
            return redirect('/');
        } else {
            return redirect($urls['url']);
        }
    }
}
