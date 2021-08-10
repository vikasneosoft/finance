<table class="table table-sm table-striped">
    <thead class="thead-color">
        <tr>
            <th>Budget For</th>
            {{-- <th>Specifications</th> --}}
            <th class="right-side-text">Quantity</th>
            <th class="right-side-text">Rate</th>
            <th class="right-side-text">Budget AMT</th>
            <th>Category</th>
            <th>Sub Category</th>
           {{--  <th>Justification or Detailing</th> --}}
            <th>More Detail</th>
            <th>Fileupload</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($budgetDetails as $value)
            <tr class="tr-{{ $value['id'] }}">
                <td>{{ $value['budget_for'] }}</td>
                {{-- <td>{{ $value['specifications'] }}</td> --}}
                <td class="right-side-text">{{ $value['budget_quantity'] }} </td>
                <td class="right-side-text">{{ IND_money_format($value['budget_rate']) }} </td>
                <td class="right-side-text"> {{ IND_money_format($value['budget_amount']) }} </td>
                <td>{{ $value['budget_category']['name'] }}</td>
                <td>{{ $value['budget_subcategory']['name'] }}</td>
                {{-- <td>{{ $value['budget_explanation'] }}</td> --}}
                <td><a id="more-detail" data-explanation="{{$value['budget_explanation']}}" data-specification="{{$value['specifications']}}" href="#">Click </a></td>
                <td>
                    @if (!empty($value['image']))
                        <a target="_blank" href="{{ URL::asset('/public/budget_images/' . $value['image']) }}">View
                            File</a>
                    @else
                        --
                    @endif
                </td>
                <td><a href="#" data-id="{{ $value['id'] }}" class="edit-detail"><i class="far fa-edit"
                            style="font-size: 20px;"></i></a>
                    <a href="#" data-id="{{ $value['id'] }}" class="delete-detail"><i class="fas fa-trash-alt"
                            style="font-size: 20px;"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
