<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses</title>
    <style>
        table,td,th{
            border: 1px solid black;
            word-break: break-word;
        }

        h3{ page-break-inside:avoid}
        tr td{
            border-top:0;
            border-left: 0;
            padding-left: 5px;
        }
        tr th{
            border-top: 0;
            border-left: 0;
        }
        tr td:last-child{
            border-right: 0;
        }
        tr th:last-child{
            border-right: 0;
        }
        .right-side-text{
            text-align: right;
        }

    </style>
</head>
<body>
    <table cellpadding="0" cellspacing="0" style="width: 80%; margin: auto; font-size: 14px; font-family: Arial;">
        <tbody>
            <tr>
                <td style="text-align: center;" colspan="4"><h1>Expense</h1></td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: #262626; color: white;">
                    <h3>Header Information</h3>
                </td>
            </tr>
            <tr>
                <td style="width: 25%; background-color: #f2f2f2">Expense Document Number:</td>
                <td style="width: 25%; ">{{ $expense['id'] }}</td>
                <td style="width: 25%; background-color: #f2f2f2">Financial year:</td>
                <td style="width: 25%; "> {{ $expense['financial_year']['year'] }}</td>
            </tr>
            <tr>
                <td style="width: 25%; background-color: #f2f2f2">Expense type:</td>
                <td style="width: 25%; ">{{ $expense['budget_type']['name'] }}</td>
                <td style="width: 25%; background-color: #f2f2f2">Cost Cnter: </td>
                <td style="width: 25%; "> {{ $expense['cost_center']['name'] }}</td>
            </tr>
            <tr>
                <td style="width: 25%; background-color: #f2f2f2">Budget code:</td>
                <td style="width: 25%; ">{{ $expense['expensive_code'] }}</td>
                <td style="width: 25%; background-color: #f2f2f2">Services are required at:</td>
                <td style="width: 25%; ">{{ $expense['location_id'] }}</td>
            </tr>
            <tr>
                <td style="width: 25%; background-color: #f2f2f2">Project Codes:</td>
                <td style="width: 25%; ">{{ $expense['project_code']['code'] }}</td>
                <td style="width: 25%; background-color: #f2f2f2">Project ref no:</td>
                <td style="width: 25%; ">{{ $expense['proj_ref_no'] }}</td>
            </tr>
            <tr>
                <td style="width: 25%; background-color: #f2f2f2">Project Incharge:</td>
                <td style="width: 25%; ">{{ $expense['project_in_charge'] }}</td>
                <td style="width: 25%; background-color: #f2f2f2">Start date:</td>
                <td style="width: 25%; ">{{ Carbon\Carbon::parse($expense['from_date'])->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="width: 25%; background-color: #f2f2f2">End date:</td>
                <td style="width: 25%; ">{{ Carbon\Carbon::parse($expense['to_date'])->format('d-m-Y') }}</td>
                <td style="width: 25%; "></td>
                <td style="width: 25%; "></td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: #262626; color: white;"><h3>Requirement and Justification </h3></td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">What is required?</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['what_is_required'] }}
                </td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">Scope of work</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['scope_of_work'] }}
                </td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">What will change?</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['what_will_change'] }}
                </td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">Why is it required?</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['why_required'] }}
                </td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">Which vendor is selected</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['vendor'] }}
                </td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">Contact details</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['vendor_contacts'] }}
                </td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">Reasons for selecting this particular vendor</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['reason_for_selecting_vendor'] }}
                </td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">Assumptions or  inclusions</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['assumptions_or_inclusions'] }}
                </td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">Exceptions or Exclusions</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['exceptions_or_exclusions'] }}
                </td>
            </tr>
            <tr>
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top;">Payment Term & conditions</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['payment_terms'] }}
                </td>
            </tr>
            <tr >
                <td style="background-color: #f2f2f2; text-align: right; padding-right: 5px; vertical-align: top; ">Warranty/Guarantee Details</td>
                <td colspan="3" style="padding-bottom: 10px;">
                    {{ $expense['warranty_guarantee_details'] }}
                </td>
            </tr>
            {{-- <tr>
                <td colspan="4" style="background-color: #262626; color: white;"><h3>Budget Detail</h3></td>
            </tr> --}}
            {{-- <tr>
                <td colspan="4" style="border: 0; padding-left: 0;">
                    <table style="width: 100%; border-spacing: 0; border: 0;">
                        <thead>
                            <tr>
                                <th style="width: 11%;">Bud For</th>
                                <th style="width: 11%;">Bud Qty</th>
                                <th style="width: 11%;">Rate</th>
                                <th style="width: 11%;">Bud AMT</th>
                                <th style="width: 11%;">Exp Qty</th>
                                <th style="width: 11%;">Exp AMT</th>
                                <th style="width: 11%;">Balance</th>
                                <th style="width: 12%;">Category</th>
                                <th style="width: 11%;">Sub Category</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($budget->budgetDetail as $key => $value)
                                        <tr >
                                            <td>{{ $value['budget_for'] }}</td>
                                            <td>{{ $value['budget_quantity'] }} </td>
                                            <td>{{ IND_money_format($value['budget_rate']) }} </td>
                                            <td>{{ IND_money_format($value['budget_amount']) }} </td>
                                            <td>

                                                @if (isset($expenseDetail[$key]['expense_quantity']))
                                                    {{ $expenseDetail[$key]['expense_quantity'] }}@else -- @endif
                                            </td>
                                            <td>

                                                @if (isset($expenseDetail[$key]['expense_amount']))
                                                    {{ IND_money_format($expenseDetail[$key]['expense_amount']) }}@else --
                                                @endif
                                            </td>
                                            <td>

                                                @if (isset($expenseDetail[$key]['balance']))
                                                    {{ IND_money_format($expenseDetail[$key]['balance']) }}@else --
                                                @endif
                                            </td>
                                            <td>{{ $value['category_name'] }}</td>
                                            <td>{{ $value['subcategory_name'] }}</td>


                                        </tr>
                                    @endforeach
                        </tbody>
                    </table>
                </td>
            </tr> --}}
            <tr>
                <td colspan="4" style="background-color: #262626; color: white;"><h3>Expense Detail</h3></td>
            </tr>
            <tr>
                <td colspan="4" style="border: 0; padding-left: 0;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%; border-spacing: 0; border: 0;">
                        <thead>
                            <tr>
                                <th style="width: 12%;">Expense For</th>
                                <th style="width: 8%;" class="right-side-text">Quantity</th>
                                <th style="width: 8%;" class="right-side-text">Rate</th>
                                <th style="width: 10%;" class="right-side-text">Expense Amt</th>
                                <th style="width: 12%;">Category</th>
                                <th style="width: 12%;">Sub Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach ($expense['expense_detail'] as $value)
                                @php $total+= $value['expensive_amount'] @endphp
                                <tr class="tr-{{ $value['id'] }}">
                                    <td>{{ $value['expensive_for'] }}</td>
                                    <td class="right-side-text">{{ $value['expensive_quantity'] }} </td>
                                    <td class="right-side-text">{{ IND_money_format($value['expensive_rate']) }} </td>
                                    <td class="right-side-text">{{ IND_money_format($value['expensive_amount']) }} </td>
                                    <td>{{ $value['category_name'] }}</td>
                                    <td>{{ $value['subcategory_name'] }}</td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border: 0; padding-left: 0;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%; border-spacing: 0; border: 0;">
                        <thead>
                            <tr>

                                <th style="width: 12%;">Specifications</th>

                                <th style="width: 26%;">Justification or Detailing</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach ($expense['expense_detail'] as $value)

                                <tr class="tr-{{ $value['id'] }}">

                                    <td>{{ $value['specifications'] }}</td>

                                    <td>{{ $value['expensive_explanation'] }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: #262626; color: white;"><h3>Approval Status</h3></td>
            </tr>
            <tr>
                <td colspan="4" style="border: 0; padding-left: 0;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%; border-spacing: 0; border: 0;">
                        <thead>
                            <tr>
                                <th style="width: 10%;">Level</th>
                                <th style="width: 30%;">Status</th>
                                <th style="width: 45%;">Reason</th>
                                <th style="width: 15%;">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    Approved by vikas
                                </td>
                                <td>
                                    --
                                </td>
                                <td>
                                    02-08-2021
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom:0">2</td>
                                <td style="border-bottom:0">Pending from -- suresh</td>
                                <td style="border-bottom:0">--</td>
                                <td style="border-bottom:0">--</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>

    </table>
</body>
</html>
