<table class="table table-sm table-striped">
    <thead class="thead-color">
        <tr>
            <th>Expense For</th>

            <th class="right-side-text">Quantity</th>
            <th class="right-side-text"> Rate</th>
            <th class="right-side-text">Expense Amount</th>
            <th>Category</th>
            <th>Sub Category</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expensiveDetails as $value)
            <tr class="tr-{{ $value['id'] }}">
                <td>{{ $value['expensive_for'] }}</td>

                <td class="right-side-text">{{ $value['expensive_quantity'] }} </td>
                <td class="right-side-text">{{ IND_money_format($value['expensive_rate']) }} </td>
                <td class="right-side-text"> {{ IND_money_format($value['expensive_amount']) }} </td>
                <td>{{ $value['budget_category']['name'] }}</td>
                <td>{{ $value['budget_subcategory']['name'] }}</td>

                <td><a href="#" data-id="{{ $value['id'] }}" class="edit-detail"><i class="far fa-edit"
                            style="font-size: 20px;"></i></a>
                    <a href="#" data-id="{{ $value['id'] }}" class="delete-detail"><i class="fas fa-trash-alt"
                            style="font-size: 20px;"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
