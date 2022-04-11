<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $city = $request->city;
        $city = strip_tags($city);
        $city = Str::lower($city);
        $city = iconv('utf-8', 'ascii//TRANSLIT', $city);

        if (isset($city) && $city != '') 
        {
            try{
                $response = Http::get('https://api.meteo.lt/v1/places/'.$city.'/forecasts/long-term');
                $response->json();
                $c1 = $response->failed();

                $c2 = $response->clientError();

                $c3 = $response->serverError();

                if ($c1 or $c2 or $c3){
                    $response->throw();
                }
                    
            } catch(\Exception $e){
                //dd($e);
                $error = $response->getStatusCode();
                return view('error.error', compact('error'));
            }

            foreach ($response['forecastTimestamps'] as $key => $value) 
            {
                $value['forecastTimeUtc'] = new Carbon($value['forecastTimeUtc']);
                $value['forecastTimeUtc'] = $value['forecastTimeUtc']->setTimeZone('Europe/Vilnius');
            }

            $date = array(Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'), 'UTC'));
            // kinda weird that it stays utc if i try to set timezone on the create from format method
            $date[0] = $date[0]->setTimeZone('Europe/Vilnius');

            $resault = array_filter($response['forecastTimestamps'], 
                function ($datetime) use ($date)
                {
                    return $datetime['forecastTimeUtc'] > $date[0];
                });
        
            $resault = array_slice($resault, 0, 5);
            
            $cloathes = array();
            foreach ($resault as $key => $value) {
                
                $value = Str::after($value['conditionCode'], '-');
                // i basically made it just rain, cloud, clear
                // so its eaier to find im so smart no way
                $value = substr($value, 0, -1);

                $item = Item::where('weather',
                                'like', '%'.$value.'%')
                ->get();
                
                foreach ($item as $x)
                {
                    if(!in_array($x, $cloathes))
                    {
                        array_push($cloathes, $x); 
                    }
                }
            }

            $data = [
                'place'=>$response['place'],
                'forecastTimestamps'=>$resault,
                'cloathes' => $cloathes,
            ];
            //dd($data);
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
        dd($request);
        $item->sku = SKU_gen($request->input('name'), 2);
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->weather = $request->input();
        $item->save();

        return 'hello';
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
