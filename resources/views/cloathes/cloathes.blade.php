<div>
    @isset($data)
        <div class="cloathes-container">
            @if (count($data['cloathes']) > 0)
                
                @foreach ($data['cloathes'] as $key => $cloathe)
                    
                    <div class="cloathes">
                        <p class="name">{{ $cloathe['name'] }}</p>
                        <p class="price">{{ $cloathe['price'] }} &#x20AC</p>
                        <p class="sku">sku {{ $cloathe['sku'] }}</p>
                    </div>

                @endforeach

            @else
                <p>Could not find anything</p>
            @endif
        </div>
        
    @endisset
</div>