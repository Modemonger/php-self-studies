<?php
    function RemoveSpecialChar($str){
        $res =  str_ireplace( array( '\'', '"',
      ',' , ';', '<', '>', '-' ), ' ', $str);

        return $res;
    }
?>

@isset($data)
<div class="weather-container">
    <div class="city-name-container">
        <h3 class="city-name">{{ $data['place']['name'] }}</h3>
    </div>

    <div class="forecast-container">
        @if (count($data['forecastTimestamps']) > 0)
            
            @foreach ($data['forecastTimestamps'] as $key => $timeStamp)
                
                <div class="forecast">
                    <p>{{ $timeStamp['forecastTimeUtc'] }}</p>
                    <p>Forcasted {{ RemoveSpecialChar($timeStamp['conditionCode']) }}</p>
                </div>

            @endforeach

        @else
            <p>Could not find anything</p>
        @endif
    </div>
</div>
@endisset
