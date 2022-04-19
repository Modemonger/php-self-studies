<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Item;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function show(Request $request)
    {
        $city = $request->city;
        $city = strip_tags($city);
        $city = Str::lower($city);
        $city = iconv('utf-8', 'ascii//TRANSLIT', $city);

        try{
            $response = Http::withOptions(['verify' => false])
                ->get('https://api.meteo.lt/v1/places/'.$city.'/forecasts/long-term');
                $c1 = $response->failed();

                $c2 = $response->clientError();

                $c3 = $response->serverError();

                if ($c1 or $c2 or $c3){
                    $response->throw();
                }
        } catch(\Exception $e){
            //dd($e);
            $error = $response;
            return $error;
        }

        $date = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'), 'UTC');

        $resault = array_values(array_filter($response['forecastTimestamps'],
            function ($datetime) use ($date)
            {
                return $datetime['forecastTimeUtc'] == $date->minute(0)->second(0);
            }));

        $resault = $resault[0];

        $weather = $resault['conditionCode'];

        $products = array();

        // simplify the search word
        $search = Str::after($resault['conditionCode'], '-');

        $item = Item::where('weather', 'like', '%'.$search.'%')->get();

            foreach ($item as $x)
            {
                if(!in_array($x, $products))
                {
                    array_push($products, $x);
                }
            }

        $data = [
            'city'=>$response['place']['name'],
            'recommendations'=>[
                'weather_forecast'=> $weather,
                'date' => $resault['forecastTimeUtc'],
                'products' => $products,
            ],
        ];

        return $data;
    }
}
