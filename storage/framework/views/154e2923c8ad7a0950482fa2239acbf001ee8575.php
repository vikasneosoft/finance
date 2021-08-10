  <aside class="main-sidebar sidebar-dark-primary elevation-4">


      <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img alt="User Image" class="img-circle elevation-2"
                      src="<?php echo e(asset('public/img/user2-160x160.jpg')); ?>">
              </div>
              <div class="info">
                  <a href="#" class="d-block">
                      <?php echo Auth::user()->name; ?> </a>
              </div>
          </div>
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item ">
                      <a href="<?php echo e(route('employee.dashboard')); ?>" class="nav-link <?php if(isset($active) && $active=='dashboard' ): ?> active <?php endif; ?>">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <?php if(Auth::user()->section_id != 0): ?>
                      <li class="nav-item ">
                          <a href="<?php echo e(route('budget.get_budgets')); ?>" class="nav-link <?php if(isset($active) && $active=='list_budget' ): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-tree"></i>
                              <p>
                                  Expenses
                              </p>
                          </a>
                      </li>
                  <?php else: ?>
                      <li class="nav-item ">
                          <a href="<?php echo e(route('budget.get_budgets')); ?>" class="nav-link <?php if(isset($active) && $active=='list_budget' ): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-tree"></i>
                              <p>
                                  Expenses
                              </p>
                          </a>
                      </li>

                      <li class="nav-item ">
                          <a href="<?php echo e(route('budget.index')); ?>" class="nav-link <?php if(isset($active) && $active=='budget' ): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Budget
                              </p>
                          </a>
                      </li>
                  <?php endif; ?>


                  <?php if(Auth::user()->section_id == 0): ?>
                      <li class="nav-item ">
                          <a href="<?php echo e(route('expenses.get_submited_expenses_by_employee')); ?>"
                              class="nav-link <?php if(isset($active) &&
                              $active=='submited-expenses-by-employee' ): ?> active <?php endif; ?>">
                              <i class="nav-icon fas fa-copy"></i>
                              <p>
                                  Pending for approvals
                              </p>
                          </a>
                      </li>
                  <?php endif; ?>

                  <?php if(Auth::user()->division_id != 0): ?>
                      <li class="nav-item ">
                          <a href="<?php echo e(route('expenses.get_submited_expenses')); ?>" class="nav-link <?php if(isset($active) && $active=='submited-expenses' ): ?> active <?php endif; ?>">
                              <i class="nav-icon fas fa-copy"></i>
                              <p>
                                  Sent for approval
                              </p>
                          </a>
                      </li>
                  <?php endif; ?>
                  <li class="nav-item ">
                      <a href="<?php echo e(route('expenses.all_expenses')); ?>" class="nav-link <?php if(isset($active) && $active=='all-expenses' ): ?> active <?php endif; ?>">
                        <i class="nav-icon far fa-calendar-alt"></i>
                          <p>
                              All expenses
                          </p>
                      </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo e(route('employee.routing_list')); ?>" class="nav-link <?php if(isset($active) && $active=='routing' ): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Approval Levels
                        </p>
                    </a>
                </li>

              </ul>
          </nav>
      </div>
  </aside>
<?php /**PATH /var/www/html/finance/resources/views/employee/sidebar.blade.php ENDPATH**/ ?>