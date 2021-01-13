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
        <a href="/buyer/dashboard">
          <i class="now-ui-icons design_app"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="{{ Request::segments()[1] == 'my-items' ? 'active' : '' }}">
        <a href="/buyer/my-items">
          <i class="now-ui-icons education_atom"></i>
          <p>My Items</p>
        </a>
      </li>
    </ul>
  </div>
</div>