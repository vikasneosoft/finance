  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <img alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"
              src="{{ asset('public/img/AdminLTELogo.png') }}">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>
      <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img alt="User Image" class="img-circle elevation-2"
                      src="{{ asset('public/img/user2-160x160.jpg') }}">
              </div>
              <div class="info">
                  <a href="#" class="d-block">
                      <?php echo Auth::guard('admin')->user()->name; ?> </a>
              </div>
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">

                  <li class="nav-item ">
                      <a href="{{ route('admin.dashboard') }}" class="nav-link @if (isset($active) && $active=='dashboard' ) active @endif">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>



                  <li class="nav-item has-treeview @if (isset($active) && ($active=='company' ||
                      $active=='division' || $active=='location' || $active=='department' || $active=='section' ||
                      $active=='budgettype' || $active=='category' || $active=='subcategory' || $active=='employe' ||
                      $active=='supplier' || $active=='budget' || $active=='approvallist' || $active=='projectcode' ||
                      $active=='costcenter' || $active=='financialyear' || $active=='rounting' )) menu-open @endif">
                      <a href="#" class="nav-link @if (isset($active) && ($active=='company' ||
                          $active=='division' || $active=='location' || $active=='department' || $active=='section' ||
                          $active=='budgettype' || $active=='category' || $active=='subcategory' || $active=='employe'
                          || $active=='supplier' || $active=='budget' || $active=='approvallist' ||
                          $active=='projectcode' || $active=='costcenter' || $active=='financialyear' ||
                          $active=='rounting' )) active @endif">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Settings
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('company.index') }}" class="nav-link @if (isset($active) && $active=='company' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Company </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('location.index') }}" class="nav-link @if (isset($active) && $active=='location' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Locations </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('division.index') }}" class="nav-link @if (isset($active) && $active=='division' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Divisions </p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('department.index') }}" class="nav-link @if (isset($active) && $active=='department' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Departments</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('section.index') }}" class="nav-link @if (isset($active) && $active=='section' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Section</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('employe.index') }}" class="nav-link @if (isset($active) && $active=='employe' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Employees</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('supplier.index') }}" class="nav-link @if (isset($active) && $active=='supplier' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Suppliers</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('budget-type.index') }}" class="nav-link @if (isset($active) && $active=='budgettype' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Budget type</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('category.index') }}" class="nav-link @if (isset($active) && $active=='category' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Categories </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('subcategory.index') }}" class="nav-link @if (isset($active) && $active=='subcategory' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Subcategories </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('project-code.index') }}" class="nav-link @if (isset($active) && $active=='projectcode' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Project code </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('cost-center.index') }}" class="nav-link @if (isset($active) && $active=='costcenter' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Cost Center </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('financial-year.index') }}" class="nav-link @if (isset($active) && $active=='financialyear' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Financial year </p>
                              </a>
                          </li>


                          <li class="nav-item">
                              <a href="{{ route('budgets.index') }}" class="nav-link @if (isset($active) && $active=='budget' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Budgets </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('rounting.index') }}" class="nav-link @if (isset($active) && $active=='rounting' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Rountings </p>
                              </a>
                          </li>


                         {{--  <li class="nav-item">
                              <a href="{{ route('approval-list.index') }}" class="nav-link @if (isset($active) && $active=='approvallist' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Approval List </p>
                              </a>
                          </li> --}}
                      </ul>
                  </li>
              </ul>
          </nav>
      </div>
  </aside>
