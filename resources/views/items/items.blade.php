<div>
    @isset($items)
        @foreach ($items as $item)
                
            <p>{{ $item->name }}</p>

        @endforeach
    @endisset
</div>