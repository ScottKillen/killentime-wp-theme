<?php

/**
 * Displays the nav search form.
 *
 */

?>

<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="seachModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content d-flex glass" role="search" method="get" action="<?php echo esc_url(home_url('/')) ?>">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="seachModalTitle">Search</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="search" class="form-control search-field" value="<?php echo get_search_query() ?>" name="s" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Go</button>
      </div>
    </form>
  </div>
</div>
