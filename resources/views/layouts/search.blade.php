<form class="search-container" action="{{ route('home') }}" method="GET" role="index">
    @csrf
    <input type="search" 
        class="search" 
        name="city"
        placeholder="Search cities"> 
    <div class="btn-container">
        <button type="submit" class="btn-default">Submit</button>
    </div>
</form>