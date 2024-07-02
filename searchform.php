<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <label aria-label="Search for:">
        <input type="search" class="search-field" placeholder="Search …" value="<?php the_search_query(); ?>" name="s">
    </label>
    <button role="button" class="search-submit" aria-label="search"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></button>
</form>
