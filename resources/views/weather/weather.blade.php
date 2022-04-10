<div>
    @isset($data)
        <h3>{{ $data['place']['name'] }}</h3>
        @if (count($data['forecastTimestamps']) > 0)
            @foreach ($data['forecastTimestamps'] as $timeStamp)
                
                <p>{{ $timeStamp['forecastTimeUtc'] }}</p>
                <p>{{ $timeStamp['conditionCode'] }}</p>

            @endforeach
        @else
            <p>Could not find anything</p>
        @endif
    @endisset
</div>