<h2>Budget Detail</h2>
<div class="col-12 table-responsive">
    <table class="table table-sm table-striped">
        <thead class="thead-color">
            <tr>
                <th>Bud For</th>
                <th class="right-side-text">Bud Qty</th>
                <th class="right-side-text">Rate</th>
                <th class="right-side-text">Bud Amt</th>
                <th class="right-side-text">Sub Qty</th>
                <th class="right-side-text">Exp Amt</th>
                <th class="right-side-text">Sub Amt</th>
                <th class="right-side-text">Balance</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($expenseDetail as $key => $value)
                <tr class="tr-{{ $value['id'] }}">
                    <td>{{ $value['budget_for'] }}</td>
                    <td class="right-side-text">{{ $value['budget_quantity'] }} </td>
                    <td class="right-side-text">{{ IND_money_format($value['budget_rate']) }} </td>
                    <td class="right-side-text">{{ IND_money_format($value['budget_amount']) }} </td>
                    <td class="right-side-text">@if(isset($value['expense_quantity']))
                        {{ $value['expense_quantity'] }}
                        @else
                        --
                        @endif
                    </td>
                    <td class="right-side-text">
                        @if(isset($budget['expenseDetail'][$key]['amount']))
                        {{$budget['expenseDetail'][$key]['amount']-$value['expense_amount']}}
                        @else
                        0
                        @endif
                    </td>
                    <td class="right-side-text">
                        @if(isset($value['expense_amount']))
                            {{ IND_money_format($value['expense_amount']) }}
                        @else
                        --
                        @endif

                    </td>
                    <td class="right-side-text">@if(isset($value['balance']))
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
