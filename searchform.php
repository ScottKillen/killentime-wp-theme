<?php
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')) ?>">
  <div class="input-group my-3">
    <span class=" input-group-text" id="basic-addon3">
      <svg class="bi">
        <use xlink:href="#fa-magnifying-glass" />
      </svg>
    </span>
    <input type="search" class="search-field form-control" id="search" value="<?php echo get_search_query() ?>" name="s">
  </div>
  <div>
    <button type="submit" class="search-submit btn btn-primary">Search</button>
  </div>
</form>
