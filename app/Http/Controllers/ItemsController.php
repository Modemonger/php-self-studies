<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

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
        $name = $request->name;
        if (isset($name)) {
            $items = Item::where('name', 'like', '%'.$name.'%')->get();
            return view('items.index',compact('items'));
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

        return redirect('/');
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
