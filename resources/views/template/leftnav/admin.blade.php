<div class="sidebar" data-color="orange">
  <div class="logo">
    <a href="#" class="simple-text logo-mini">
      EC
    </a>
    <a href="#" class="simple-text logo-normal">
      E-Commerce
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="{{ Request::segments()[1] == 'dashboard' ? 'active' : '' }}">
        <a href="/admin/dashboard">
          <i class="now-ui-icons design_app"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="{{ Request::segments()[1] == 'items' ? 'active' : '' }}">
        <a href="/admin/items">
          <i class="now-ui-icons education_atom"></i>
          <p>Items</p>
        </a>
      </li>
      <li class="{{ Request::segments()[1] == 'sellers' ? 'active' : '' }}">
        <a href="/admin/sellers">
          <i class="now-ui-icons location_map-big"></i>
          <p>Sellers</p>
        </a>
      </li>
    </ul>
  </div>
</div>