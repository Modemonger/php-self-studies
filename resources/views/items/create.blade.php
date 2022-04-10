<div>
    <div>
        <h2>Add an item of cloathing</h2>
    </div>
</div>

<div>
    <form action="/create/store" method="GET" role="create">
        @csrf
        <div>
            <input type="text"
            name="name" 
            id="item-name"
            class="text_input"
            placeholder="Item name...">
            @error('name')
                <div>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <input type="number"
            name="price" 
            id="item-price"
            class="text_input"
            placeholder="Item price...">
            @error('price')
                <div>
                    {{ $message }}
                </div>
            @enderror
        </div>
        

        <label class="weather_check">
            In what weather would you wear this item?
                
                <label for="cloudy">Cloudy</label>
                <input type="checkbox" 
                    name="cloudy" 
                    id="cloudy-check" 
                    class="check">

                <label for="clear">Clear</label>
                <input type="checkbox" 
                    name="clear" 
                    id="clear-check" 
                    class="check">

                <label for="rain">Rainy</label>
                <input type="checkbox" 
                    name="rain" 
                    id="rain-check" 
                    class="check">

        </label>
        <input type="submit" value="Submit">
    </form>
</div>