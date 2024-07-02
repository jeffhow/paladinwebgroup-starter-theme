<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <label>
        <span class="screen-reader-text">Search for:</span>
        <input type="search" class="search-field" placeholder="Search …" value="<?php the_search_query(); ?>" name="s">
    </label>
    <button role="button" class="search-submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
</form>
