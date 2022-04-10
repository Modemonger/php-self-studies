<form class="search-container" action="/" method="GET" role="search">
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