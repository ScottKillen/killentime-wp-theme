<?php defined('ABSPATH') || exit; ?>

<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="seachModalTitle" aria-hidden="true">
  <search class="modal-dialog modal-dialog-centered">
    <form itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" class="modal-content d-flex glass" method="get" action="<?php echo esc_url(home_url('/')) ?>">
      <div class="modal-header">
        <p class="modal-title fs-5 text-light" id="seachModalTitle">Search</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="search" itemprop="query-input" class="form-control search-field" value="<?php echo get_search_query() ?>" name="s" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Go</button>
      </div>
      <meta itemprop="target" content="<?php echo home_url('/?s={search} '); ?>" />
    </form>
  </search>
</div>
