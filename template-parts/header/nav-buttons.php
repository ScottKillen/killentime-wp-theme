<?php defined('ABSPATH') || exit; ?>
<ul class="navbar-nav flex-rowflex-wrap ms-md-auto">
  <li class="nav-item">
    <button type="button" class="btn py-2" data-bs-toggle="modal" data-bs-target="#searchModal">
      <svg class="bi">
        <use xlink:href="#fa-magnifying-glass" />
      </svg>
    </button>
  </li>
  <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
    <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
    <hr class="d-lg-none my-2 text-white-50">
  </li>
  <?php get_template_part(
    'template-parts/social',
    'icons',
    array(
      'social-class' => 'pt-1',
    )
  ); ?>
  <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
    <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
    <hr class="d-lg-none my-2 text-white-50">
  </li>
  <li id="color-mode-switcher" class="nav-item dropdown">
    <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (auto)">
      <svg class="bi my-1 theme-icon-active">
        <use href="fa-circle-half-strokecircle-half"></use>
      </svg>
      <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
          <svg class="bi me-2 opacity-50 theme-icon">
            <use href="#fa-sun-bright"></use>
          </svg>Light<svg class="bi ms-auto d-none">
            <use href="#fa-check"></use>
          </svg>
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
          <svg class="bi me-2 opacity-50 theme-icon">
            <use href="#fa-moon-stars"></use>
          </svg>Dark<svg class="bi ms-auto d-none">
            <use href="#fa-check"></use>
          </svg>
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
          <svg class="bi me-2 opacity-50 theme-icon">
            <use href="#fa-circle-half-stroke"></use>
          </svg>Auto<svg class="bi ms-auto d-none">
            <use href="#fa-check"></use>
          </svg>
        </button>
      </li>
    </ul>
  </li>
</ul>
