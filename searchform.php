<?php defined('ABSPATH') || exit; ?>
<search>
  <form method="get" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" class="search-form" action="<?php echo esc_url(home_url('/')) ?>">
    <div class="input-group my-3">
      <!-- Search icon -->
      <span class="input-group-text" id="basic-addon3">
        <svg class="bi">
          <use xlink:href="#fa-magnifying-glass" />
        </svg>
      </span>
      <!-- Search input field -->
      <input type="search" itemprop="query-input" class="search-field form-control" id="search" value="<?php echo get_search_query() ?>" name="s">
    </div>
    <!-- Submit button -->
    <div>
      <button type="submit" class="search-submit btn btn-primary">Search</button>
    </div>
    <meta itemprop="target" content="<?php echo home_url('/?s={search} '); ?>" />
  </form>
</search>
