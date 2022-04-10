<form class="search-container" action="{{ route('home') }}" method="GET" role="index">
    @csrf
    <div class="input-group">

        <input type="text" 
            class="form-control" 
            name="name"
            placeholder="Search cities"> 
            <span class="input-group-btn">
            <button type="submit" class="btn-default">Submit</button>
        </span>
    </div>
</form>