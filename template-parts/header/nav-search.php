<?php

/**
 * Displays the nav search form.
 *
 */

?>
<div class="container-fluid">
  <form role="search" method="get" class="d-flex" action="<?php echo esc_url(home_url('/')) ?>">
    <div class="input-group">
      <!-- Search input field -->
      <input type="search" class="search-field form-control" id="search" value="<?php echo get_search_query() ?>" name="s">
      <!-- Search icon -->
      <span class="input-group-text">
        <svg class="bi">
          <use xlink:href="#fa-magnifying-glass" />
        </svg>
      </span>
    </div>
  </form>
</div>
