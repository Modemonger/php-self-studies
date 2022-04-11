<div class="weather-container">
    @isset($data)

        <div class="city-name-container">
            <h3 class="city-name">{{ $data['place']['name'] }}</h3>
        </div>

        <div class="forecast-container">
            @if (count($data['forecastTimestamps']) > 0)
                
                @foreach ($data['forecastTimestamps'] as $key => $timeStamp)
                    
                    <div class="forecast">
                        <p>{{ $timeStamp['forecastTimeUtc'] }}</p>
                        <p>{{ $timeStamp['conditionCode'] }}</p>
                    </div>

                @endforeach

            @else
                <p>Could not find anything</p>
            @endif
        </div>
        
    @endisset
</div>