<table class="table table-striped">
    <thead>
        <tr>
            <th>Expense For</th>
            <th>Specifications</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Expense Amount</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Justification or Detailing</th>
            <th>Fileupload</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expensiveDetails as $value)
            <tr class="tr-{{ $value['id'] }}">
                <td>{{ $value['expensive_for'] }}</td>
                <td>{{ $value['specifications'] }}</td>
                <td>{{ $value['expensive_quantity'] }} </td>
                <td>{{ IND_money_format($value['expensive_rate']) }} </td>
                <td>{{ IND_money_format($value['expensive_amount']) }} </td>
                <td>{{ $value['budget_category']['name'] }}</td>
                <td>{{ $value['budget_subcategory']['name'] }}</td>
                <td>{{ $value['expensive_explanation'] }}</td>
                <td><a target="_blank" href="{{ URL::asset('/public/budget_images/' . $value['image']) }}">View
                        File</a></td>
                <td><a href="#" data-id="{{ $value['id'] }}" class="edit-detail"><i class="far fa-edit"
                            style="font-size: 20px;"></i></a>
                    <a href="#" data-id="{{ $value['id'] }}" class="delete-detail"><i class="fas fa-trash-alt"
                            style="font-size: 20px;"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
