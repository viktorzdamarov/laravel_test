<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class urlGeneratorController extends Controller
{
    public function main() {
        return view('layout');
    }

    private function genShortUrl($length = 6) {
        $chars = '1234567890qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP';
        $size = strlen($chars) - 1;
        $password = '';
        while($length--) {
            $password .= $chars[random_int(0, $size)];
        }
        $users = DB::select('select * from app_routes where denst_url = "' . $password . '"');
        if (count($users) == 0)
            return $password;
        else $this->genShortUrl();
    }

    private function testSourceUrl($source_url) {
       // if (!filter_var($source_url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) return false;
        try {
            $response = Http::get($source_url);
        } catch(\Exception $ex) {
            return false;
        }
        return $response->ok();
    }

    public function getShortUrl(Request $request) {
        $source_url = $request->input('source-url');
        if (!filter_var($source_url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
            $source_url = 'https://' . $source_url;
        }
        if (!$this->testSourceUrl($source_url)) {
            return view('url_generator', ['status' => false, 'message' => 'ссылка не валидна']);
        }
        $users = DB::select('select denst_url from app_routes where source_url = "' . $source_url . '"');
        if (count($users) == 0) {
            $denst_url = $this->genShortUrl();
            DB::insert('insert into app_routes(`source_url`,`denst_url`) values("' . $source_url . '","' .  $denst_url. '")');
        } else {
            $denst_url = $users[0]->denst_url;
        }
        $denst_url = request()->getSchemeAndHttpHost() . '/' . $denst_url;
        return view('url_generator', ['status' => true, 'denst_url' => $denst_url, 'source_url' => $source_url]);
    }

    public function redirectShortUrl($denst_url) {
        $users = DB::select('select source_url from app_routes where denst_url = "' . $denst_url . '"');
        if (count($users) == 0) {
           return false;
        } else {
            return $users[0]->source_url;
        }
    }
}
