@isset($data)
    <div class="cloathes-container">
        <h3 class="recommendation">We recommend that you get</h3>
        <div class="cloathes">
            @if (count($data['cloathes']) > 0)
                
                @foreach ($data['cloathes'] as $key => $cloathe)
                    
                    <div class="item">
                        <p class="name">{{ $cloathe['name'] }}</p>
                        <p class="price">{{ $cloathe['price'] }} &#x20AC</p>
                        {{-- <p class="sku">sku {{ $cloathe['sku'] }}</p> --}}
                    </div>

                @endforeach

            @else
                <p>Could not find anything</p>
            @endif
        </div>
    </div>
@endisset
