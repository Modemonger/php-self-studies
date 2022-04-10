<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Item;
use Illuminate\Support\Str;
use Carbon\Carbon;

function SKU_gen($string, $id = null){
    $results = '';
    $vowels = array('a', 'e', 'i', 'o', 'u', 'y');
    preg_match_all('/[A-Z][a-z]*/', ucfirst($string), $match);
    foreach($match[0] as $substring){
        $substring = str_replace($vowels, '', strtolower($substring));
        $results .= preg_replace('/([a-z]{1})(.*)/', '$1', $substring);
    }
    $results .= '-'. str_pad($id, 5, 0, STR_PAD_LEFT);
    return $results;
}

class ItemsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $city = $request->name;
        $city = strip_tags($city);
        $city = Str::lower($city);
        
        if (isset($city) && $city != '') {

            $response = Http::get('https://api.meteo.lt/v1/places/'.$city.'/forecasts/long-term');
            $response->json();
            foreach ($response['forecastTimestamps'] as $key => $value) {
                $value['forecastTimeUtc'] = new Carbon($value['forecastTimeUtc']);
                $value['forecastTimeUtc'] = $value['forecastTimeUtc']->setTimeZone('Europe/Vilnius');
            }

            $date = array(Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'), 'UTC'));
            $date[0] = $date[0]->setTimeZone('Europe/Vilnius');

            $result = array_filter($response['forecastTimestamps'], 
                function ($datetime) use ($date) {
                    return $datetime['forecastTimeUtc'] > $date[0];
                });

            $data = [
                'place'=>$response['place'],
                'forecastTimestamps'=>array_slice($result, 0, 5),
            ];

            return view('items.index',compact('data'));
        }

        return view('items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'price' => ['required', 'integer'],
        ]);

        $item = new Item;
        $item->sku = SKU_gen($request->input('name'), 2);
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->clear = $request
            ->whenHas('clear', function ($input) {
                if($input == 'on')
                    return true;
            
                return false;
            }, function () {
                return false;
            });
        $item->cloudy = $request
            ->whenHas('cloudy', function ($input) {
                if($input == 'on')
                    return true;
            
                return false;
            }, function () {
                return false;
            });
        $item->rain = $request
            ->whenHas('rain', function ($input) {
                if($input == 'on')
                    return true;
            
                return false;
            }, function () {
                return false;
            });
        $item->save();

        return view('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
