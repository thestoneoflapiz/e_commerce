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
        <a href="/seller/dashboard">
          <i class="now-ui-icons design_app"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="{{ Request::segments()[1] == 'items' ? 'active' : '' }}">
        <a href="/seller/items">
          <i class="now-ui-icons education_atom"></i>
          <p>Items</p>
        </a>
      </li>
      <li class="{{ Request::segments()[1] == 'orders' ? 'active' : '' }}">
        <a href="/seller/orders">
          <i class="now-ui-icons location_map-big"></i>
          <p>SOLD</p>
        </a>
      </li>
      @if(Auth::user()->buyer_mode)
      <li class="{{ Request::segments()[1] == 'my-items' ? 'active' : '' }}">
        <a href="/seller/my-items">
          <i class="now-ui-icons education_atom"></i>
          <p>My Items</p>
        </a>
      </li>
      @endif
    </ul>
  </div>
</div>