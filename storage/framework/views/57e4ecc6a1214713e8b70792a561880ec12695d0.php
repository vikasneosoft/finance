  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <img alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"
              src="<?php echo e(asset('public/img/AdminLTELogo.png')); ?>">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>
      <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img alt="User Image" class="img-circle elevation-2"
                      src="<?php echo e(asset('public/img/user2-160x160.jpg')); ?>">
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
                      <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php if(isset($active) && $active=='dashboard' ): ?> active <?php endif; ?>">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>



                  <li class="nav-item has-treeview <?php if(isset($active) && ($active=='company' ||
                      $active=='division' || $active=='location' || $active=='department' || $active=='section' ||
                      $active=='budgettype' || $active=='category' || $active=='subcategory' || $active=='employe' ||
                      $active=='supplier' || $active=='budget' || $active=='approvallist' || $active=='projectcode' ||
                      $active=='costcenter' || $active=='financialyear' || $active=='rounting' )): ?> menu-open <?php endif; ?>">
                      <a href="#" class="nav-link <?php if(isset($active) && ($active=='company' ||
                          $active=='division' || $active=='location' || $active=='department' || $active=='section' ||
                          $active=='budgettype' || $active=='category' || $active=='subcategory' || $active=='employe'
                          || $active=='supplier' || $active=='budget' || $active=='approvallist' ||
                          $active=='projectcode' || $active=='costcenter' || $active=='financialyear' ||
                          $active=='rounting' )): ?> active <?php endif; ?>">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Settings
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="<?php echo e(route('company.index')); ?>" class="nav-link <?php if(isset($active) && $active=='company' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Company </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php echo e(route('location.index')); ?>" class="nav-link <?php if(isset($active) && $active=='location' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Locations </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php echo e(route('division.index')); ?>" class="nav-link <?php if(isset($active) && $active=='division' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Divisions </p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="<?php echo e(route('department.index')); ?>" class="nav-link <?php if(isset($active) && $active=='department' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Departments</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="<?php echo e(route('section.index')); ?>" class="nav-link <?php if(isset($active) && $active=='section' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Section</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="<?php echo e(route('employe.index')); ?>" class="nav-link <?php if(isset($active) && $active=='employe' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Employees</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="<?php echo e(route('supplier.index')); ?>" class="nav-link <?php if(isset($active) && $active=='supplier' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Suppliers</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="<?php echo e(route('budget-type.index')); ?>" class="nav-link <?php if(isset($active) && $active=='budgettype' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Budget type</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php echo e(route('category.index')); ?>" class="nav-link <?php if(isset($active) && $active=='category' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Categories </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php echo e(route('subcategory.index')); ?>" class="nav-link <?php if(isset($active) && $active=='subcategory' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Subcategories </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php echo e(route('project-code.index')); ?>" class="nav-link <?php if(isset($active) && $active=='projectcode' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Project code </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php echo e(route('cost-center.index')); ?>" class="nav-link <?php if(isset($active) && $active=='costcenter' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Cost Center </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php echo e(route('financial-year.index')); ?>" class="nav-link <?php if(isset($active) && $active=='financialyear' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Financial year </p>
                              </a>
                          </li>


                          <li class="nav-item">
                              <a href="<?php echo e(route('budgets.index')); ?>" class="nav-link <?php if(isset($active) && $active=='budget' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Budgets </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php echo e(route('rounting.index')); ?>" class="nav-link <?php if(isset($active) && $active=='rounting' ): ?> active <?php endif; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> Rountings </p>
                              </a>
                          </li>


                         
                      </ul>
                  </li>
              </ul>
          </nav>
      </div>
  </aside>
<?php /**PATH /var/www/html/finance/resources/views/admin/sidebar.blade.php ENDPATH**/ ?>