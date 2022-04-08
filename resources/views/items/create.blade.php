@section('content')
    
    <div>
        <div>
            <h2>Add an item of cloathing</h2>
        </div>
    </div>

    <div>
        <form action="">
            <div>
                <input type="text"
                    name="name" 
                    id="item_name"
                    class="text_input"
                    placeholder="Item name...">
                
                <input type="number"
                    name="price" 
                    id="item_price"
                    class="text_input"
                    placeholder="Item price...">

                <label class="weather_check">
                    In what weather would you wear this item?
                        
                        <label for="cloudy">Cloudy</label>
                        <input type="checkbox" 
                            name="cloudy" 
                            id="cloudy_check" 
                            class="check">

                        <label for="clear">Clear</label>
                        <input type="checkbox" 
                            name="clear" 
                            id="clear_check" 
                            class="check">
    
                        <label for="rain">Rainy</label>
                        <input type="checkbox" 
                            name="rain" 
                            id="rain_check" 
                            class="check">

                </label>
            </div>
        </form>
    </div>

@endsection