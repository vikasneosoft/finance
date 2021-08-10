<table class="table table-striped">
    <thead>
        <tr>
            <th>Budget For</th>
            <th>Specifications</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Budget AMT</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Justification or Detailing</th>
            <th>Fileupload</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($budgetDetails as $value)
            <tr class="tr-{{ $value['id'] }}">
                <td>{{ $value['budget_for'] }}</td>
                <td>{{ $value['specifications'] }}</td>
                <td>{{ $value['budget_quantity'] }} </td>
                <td>{{ IND_money_format($value['budget_rate']) }} </td>
                <td>{{ IND_money_format($value['budget_amount']) }} </td>
                <td>{{ $value['budget_category']['name'] }}</td>
                <td>{{ $value['budget_subcategory']['name'] }}</td>
                <td>{{ $value['budget_explanation'] }}</td>
                <td><a target="_blank" href="{{ URL::asset('/public/budget_images/' . $value['image']) }}">View
                        File</a></td>
                <td><a href="#" data-id="{{ $value['id'] }}" class="edit-detail btn-success btn-sm">Edit</a>
                    <a href="#" data-id="{{ $value['id'] }}" class="delete-detail btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
