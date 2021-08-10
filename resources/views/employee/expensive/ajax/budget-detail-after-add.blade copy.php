<h2>Budget Detail</h2>
<div class="col-12 table-responsive">
    <table class="table table-sm table-striped">
        <thead class="thead-color">
            <tr>
                <th>Bud For</th>
                <th>Bud Qty</th>
                <th>Rate</th>
                <th>Bud Amt</th>
                <th>Exp Qty</th>
                <th>Exp Amt</th>
                <th>Balance</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($expenseDetail as $key => $value)
                                    <tr class="tr-{{ $value['id'] }}">
                                        <td>{{ $value['budget_for'] }}</td>
                                        <td>{{ $value['budget_quantity'] }} </td>
                                        <td>{{ IND_money_format($value['budget_rate']) }} </td>
                                        <td>{{ IND_money_format($value['budget_amount']) }} </td>
                                        <td>@if(isset($value['expense_quantity']))
                                            {{ $value['expense_quantity'] }}
                                            @else
                                            --
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($value['expense_amount']))
                                            {{ IND_money_format($value['expense_amount']) }}
                                            @else
                                            --
                                            @endif

                                            </td>
                                        <td>@if(isset($value['balance']))
                                            {{ IND_money_format($value['balance']) }}

                                            @else
                                            --
                                            @endif
                                        </td>
                                        <td>{{ $value['cat_name'] }}</td>
                                        <td>{{ $value['sub_cat_name'] }}</td>
                                        <td>

                                                <a href="#" data-balance=@if(isset($value['balance'])){{$value['balance']}} @else 1 @endif data-id="{{ $value['id'] }}" class="load-form-element">Add Detail</a>

                                        </td>
                                    </tr>
                                @endforeach
        </tbody>
    </table>
</div>
