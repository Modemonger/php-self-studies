@isset($data)
<div class="weather-container">
    <div class="city-name-container">
        <h3 class="city-name">{{ $data->city }}</h3>
    </div>

    <div class="forecast-container">
        <div class="forecast">
            <p>{{ $data->recommendations->date }}</p>
            <p>Forcasted {{ $data->recommendations->weather_forecast }}</p>
        </div>
    </div>
</div>
@endisset
