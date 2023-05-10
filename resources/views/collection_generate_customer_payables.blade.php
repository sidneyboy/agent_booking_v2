<style>
    /* #accounts_payable th:first-child, */
    #accounts_payable td:first-child {
        position: sticky;
        left: 0px;
        background-color: antiquewhite;
    }

    /* #accounts_payable th:nth-child(3),
    #accounts_payable td:nth-child(3) {
        position: sticky;
        left: 0px;
        background-color: antiquewhite;
    } */
</style>
<form id="collection_generate_generate_number_of_transactions">
    <div class="table table-responsive">
        <table class="table table-bordered table-sm" id="accounts_payable">
            <thead>
                <tr>
                    <th>Store Name</th>
                    <th>DR</th>
                    <th>Date Delivered</th>
                    <th>Principal</th>
                    <th>Sku Type</th>
                    <th>Status</th>
                    <th>Mode of Payment</th>
                    <th>Amount</th>
                    <th>Amount Paid</th>
                    <th>Current Bo</th>
                    <th>Balance</th>
                    <th>No of Transactions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales_register as $data)
                    <tr>
                        <td>{{ $data->customer->store_name }}</td>
                        <td>{{ $data->dr }}</td>
                        <td>{{ $data->date_delivered }}</td>
                        <td>{{ $data->principal->principal }}</td>
                        <td>{{ $data->sku_type }}</td>
                        <td>{{ $data->status }}</td>
                        <td style="text-transform: uppercase">
                            {{ $data->customer->mode_of_transaction }}
                            <input type="hidden" name="sales_register_mode_of_transaction[{{ $data->id }}]"
                                value="{{ $data->customer->mode_of_transaction }}">
                        </td>
                        <td style="text-align: right">{{ number_format($data->total_amount, 2, '.', ',') }}</td>
                        <td style="text-align: right">{{ number_format($data->amount_paid, 2, '.', ',') }}</td>
                        <td style="text-align: right">
                            @if($data->bad_order)
                                {{ number_format($data->bad_order->total_bo, 2, '.', ',') }}
                                @php
                                    $total_bo = $data->bad_order->total_bo;
                                @endphp
                            @else 
                                @php
                                    $total_bo = 0;
                                @endphp
                            @endif
                        </td>
                        <td style="text-align: right">
                            @php
                                $sales_register_balance = $data->total_amount - $data->amount_paid - $total_bo;
                                echo number_format($sales_register_balance, 2, '.', ',');
                            @endphp
                            <input type="hidden" value="{{ $sales_register_balance }}" name="sales_register_balance[{{ $data->id }}]">
                            <input type="hidden" value="{{ $total_bo}}"
                                name="sales_register_total_bo[{{ $data->id }}]">
                        </td>

                        <td>

                            <input type="number" min="0" style="width:150px;"
                                name="sales_register_number_of_transactions[{{ $data->id }}]" class="form-control">


                            <input type="hidden" name="sales_register_store_name[{{ $data->id }}]"
                                value="{{ $data->customer->store_name }}">
                            <input type="hidden" name="sales_register_id[]" value="{{ $data->id }}">
                            <input type="hidden" name="sales_register_dr[{{ $data->id }}]" value="{{ $data->dr }}">
                            <input type="hidden" value="{{ $data->total_amount }}" name="sales_register_total_amount[{{ $data->id }}]">
                            <input type="hidden" value="{{ $data->amount_paid }}" name="sales_register_amount_paid[{{ $data->id }}]">
                            <input type="hidden" value="{{ $data->sku_type }}" name="sales_register_sku_type[{{ $data->id }}]">
                            <input type="hidden" value="{{ $data->principal_id }}" name="sales_register_principal_id[{{ $data->id }}]">
                            <input type="hidden" value="{{ $data->principal_id }}" name="sales_register_principal_id[{{ $data->id }}]">
                            <input type="hidden" value="{{ $data->principal->principal }}"
                                name="sales_register_principal[{{ $data->id }}]">

                        </td>
                    </tr>
                @endforeach
                {{-- @foreach ($sales_order as $data)
                    <tr>
                        <td>{{ $data->customer->store_name }}</td>
                        <td>No Invoice Yet</td>
                        <td>N/A</td>
                        <td>{{ $data->principal->principal }}</td>
                        <td>{{ $data->sku_type }}</td>
                        <td>{{ $data->status }}</td>
                        <td style="text-transform: uppercase">
                            {{ $data->customer->mode_of_transaction }}
                            <input type="hidden" name="sales_order_mode_of_transaction"
                                value="{{ $data->customer->mode_of_transaction }}">
                        </td>
                        <td style="text-align: right">{{ number_format($data->total_amount, 2, '.', ',') }}</td>
                        <td style="text-align: right">{{ number_format($data->amount_paid, 2, '.', ',') }}</td>
                        <td style="text-align: right">0.00</td>
                        <td style="text-align: right">
                            @php
                                $sales_order_balance = $data->total_amount - $data->amount_paid;
                                echo number_format($sales_order_balance, 2, '.', ',');
                            @endphp
                            <input type="hidden" name="sales_order_balance"
                                value="{{ $sales_order_balance }}">
                        </td>
                       
                        <td>
                            <input type="number" min="0" style="width:150px;"
                                name="sales_order_number_of_transactions" class="form-control">



                            <input type="hidden" name="" id="sales_order_store_name"
                                value="{{ $data->customer->store_name }}">
                            <input type="hidden" value="{{ $data->principal_id }}"
                                name="sales_order_principal_id">
                            <input type="hidden" value="{{ $data->total_amount }}"
                                name="sales_order_total_amount">
                            <input type="hidden" value="{{ $data->sku_type }}"
                                name="sales_order_sku_type">
                            <input type="hidden" value="{{ $data->principal->principal }}"
                                name="sales_order_principal">
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
    <input type="hidden" value="{{ $customer_id }}" name="customer_id">
    <button type="submit" class="btn btn-info btn-block">PROCEED</button>
</form>


<script>
    $('[class=currency-default]').maskNumber();
    $('[class=currency-data-attributes]').maskNumber();
    $('[class=currency-configuration]').maskNumber({
        decimal: '_',
        thousands: '*'
    });
    $('[class=integer-default]').maskNumber({
        integer: true
    });
    $('[class=integer-data-attribute]').maskNumber({
        integer: true
    });
    $('[class=integer-configuration]').maskNumber({
        integer: true,
        thousands: '_'
    });

    $("#collection_generate_generate_number_of_transactions").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "collection_generate_generate_number_of_transactions",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                $('#collection_generate_generate_number_of_transactions_page').html(data);
            },
        });
    }));
</script>
