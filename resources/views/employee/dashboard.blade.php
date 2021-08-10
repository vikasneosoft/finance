@extends('employee.layout')
@section('title')
    Dashboard
@endsection
@section('employee-content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dataTables_wrapper dt-bootstrap4">
                                    <h4>Type Status</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-sm table-bordered">
                                                <thead class="thead-color">
                                                  <tr>
                                                    <th>Fin Year</th>
                                                        <th>Type</th>
                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($typeStatus as $value)
                                                        <tr>
                                                            <td>{{ $value['year'] }}</td>
                                                            <td>{{ $value['type'] }}</td>
                                                            <td style="text-align: right;">{{ IND_money_format($value['budget_amount']) }}</td>
                                                            <td style="text-align: right;">{{ IND_money_format($value['expense_amount']) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                              </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dataTables_wrapper dt-bootstrap4">
                                    <h4>Category Status</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-sm table-bordered">
                                                <thead class="thead-color">
                                                    <tr role="row">
                                                        <th>Fin Year</th>
                                                        <th>Type</th>
                                                        <th>Category</th>

                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($categoryStatus as $value)
                                                        <tr>
                                                            <td>{{ $value['year'] }}</td>
                                                            <td>{{ $value['type'] }}</td>
                                                            <td>{{ $value['cat_name'] }}</td>

                                                            <td style="text-align: right;"> {{ IND_money_format($value['budget_amount']) }}</td>

                                                            <td style="text-align: right;">

                                                                {{ IND_money_format($value['expense_amount']) }}

                                                            </td>

                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dataTables_wrapper dt-bootstrap4">
                                    <h4>Category Subcategory Status</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table x-table-responsive table-sm table-bordered table-striped category-subcategory-datatable">
                                                <thead class="thead-color">
                                                    <tr role="row">
                                                        <th>Fin Year</th>
                                                        <th>Type</th>
                                                        <th>Category</th>
                                                        <th>SubCategory</th>
                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($catSubCatStatus as $value)
                                                        <tr>
                                                            <td>{{ $value['year'] }}</td>
                                                            <td>{{ $value['type'] }}</td>
                                                            <td>{{ $value['cat_name'] }}</td>
                                                            <td>{{ $value['sub_cat_name'] }}</td>
                                                            <td>{{ IND_money_format($value['budget_amount']) }}</td>

                                                            <td>

                                                                {{ IND_money_format($value['expense_amount']) }}

                                                            </td>

                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('employee-js')


    <script type="text/javascript">
        $(document).ready(function() {
            $('.category-subcategory-datatable').DataTable({
                    columnDefs: [ {
                    targets: [4,5],
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'right');
                    }
                    } ],
                });

        });
    </script>
@endsection
