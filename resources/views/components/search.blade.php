<form method="get" class="mb-3">
    <div class="row">
        <div class="col-sm">
            <input type="search" class="form-control form-control-sm" placeholder="Type your search here..."
                name="term" {!! $attributes !!}>
        </div>
        <div class="col-sm-auto">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
                Search
            </button>
        </div>
    </div>
</form>
