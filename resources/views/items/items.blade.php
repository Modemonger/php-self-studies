<div>
    @isset($items)
        @if (count($items) > 0)
            @foreach ($items as $item)
                    
                <p>{{ $item->name }}</p>

            @endforeach
        @else
            <p>Could not find anything</p>
        @endif
    @endisset
</div>