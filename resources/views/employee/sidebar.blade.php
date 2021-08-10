  <aside class="main-sidebar sidebar-dark-primary elevation-4">


      <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img alt="User Image" class="img-circle elevation-2"
                      src="{{ asset('public/img/user2-160x160.jpg') }}">
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
                      <a href="{{ route('employee.dashboard') }}" class="nav-link @if (isset($active) && $active=='dashboard' ) active @endif">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  @if (Auth::user()->section_id != 0)
                      <li class="nav-item ">
                          <a href="{{ route('budget.get_budgets') }}" class="nav-link @if (isset($active) && $active=='list_budget' ) active @endif">
                            <i class="nav-icon fas fa-tree"></i>
                              <p>
                                  Expenses
                              </p>
                          </a>
                      </li>
                  @else
                      <li class="nav-item ">
                          <a href="{{ route('budget.get_budgets') }}" class="nav-link @if (isset($active) && $active=='list_budget' ) active @endif">
                            <i class="nav-icon fas fa-tree"></i>
                              <p>
                                  Expenses
                              </p>
                          </a>
                      </li>

                      <li class="nav-item ">
                          <a href="{{ route('budget.index') }}" class="nav-link @if (isset($active) && $active=='budget' ) active @endif">
                            <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Budget
                              </p>
                          </a>
                      </li>
                  @endif


                  @if (Auth::user()->section_id == 0)
                      <li class="nav-item ">
                          <a href="{{ route('expenses.get_submited_expenses_by_employee') }}"
                              class="nav-link @if (isset($active) &&
                              $active=='submited-expenses-by-employee' ) active @endif">
                              <i class="nav-icon fas fa-copy"></i>
                              <p>
                                  Pending for approvals
                              </p>
                          </a>
                      </li>
                  @endif

                  @if (Auth::user()->division_id != 0)
                      <li class="nav-item ">
                          <a href="{{ route('expenses.get_submited_expenses') }}" class="nav-link @if (isset($active) && $active=='submited-expenses' ) active @endif">
                              <i class="nav-icon fas fa-copy"></i>
                              <p>
                                  Sent for approval
                              </p>
                          </a>
                      </li>
                  @endif
                  <li class="nav-item ">
                      <a href="{{ route('expenses.all_expenses') }}" class="nav-link @if (isset($active) && $active=='all-expenses' ) active @endif">
                        <i class="nav-icon far fa-calendar-alt"></i>
                          <p>
                              All expenses
                          </p>
                      </a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route('employee.routing_list') }}" class="nav-link @if (isset($active) && $active=='routing' ) active @endif">
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
