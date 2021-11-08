<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class HolidayController extends Controller
{
    public function getHolidays()
    {
        $url = "https://holidays-jp.github.io/api/v1/date.json"; //外部API使用
        $method = "GET";

        $client = new Client();
        $response = $client->request($method, $url);
        $holidays = $response->getBody();

        return $holidays;
    }

    public function getHoliday(Request $request)
    {
        $date = $request->date;
        $url = "http://api.national-holidays.jp/".$date; //外部API使用
        $method = "GET";

        $client = new Client();
        $response = $client->request($method, $url);
        $holidays = $response->getBody();

        return $holidays;
    }
    
}
