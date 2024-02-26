<form id="collection_generate_final_summary">
    <div class="table table-responsive">
        <table class="table table-bordered table-sm" id="accounts_payable">
            <thead>
                <tr>
                    <td rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        OR No
                    </td>
                    <td rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        DR
                    </td>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Store Name
                    </th>
                    {{-- <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Date Delivered
                    </th> --}}
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center;">
                        Principal
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Sku Type
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Mode of Payment
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Amount
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Amount Paid
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        T-BO
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        T-RGS
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Balance
                    </th>



                    <th colspan="2" width="500px;" style="text-align: center;font-weight:bold;">
                        Cash Collection
                    </th>
                    <th colspan="2" width="500px;" style="text-align: center;font-weight:bold;">
                        Cheque Collection
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Less: Refer
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Specify
                    </th>
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                        Remarks
                    </th>
                </tr>
                <tr>

                    <th style=" width:73px">
                        <p style="text-align:center"><span style="font-size:11pt"><strong><span
                                        style="font-size:12.0pt">CASH</span></strong></span></p>
                    </th>
                    <th style=" width:74px">
                        <p style="text-align:center"><span style="font-size:11pt"><strong><span
                                        style="font-size:12.0pt">ADD: REFER</span></strong></span></p>
                    </th>
                    <th style=" width:79px">
                        <p style="text-align:center"><span style="font-size:11pt"><strong><span
                                        style="font-size:12.0pt">CHEQUE</span></strong></span></p>
                    </th>
                    <th style=" width:70px">
                        <p style="text-align:center"><span style="font-size:11pt"><strong><span
                                        style="font-size:12.0pt">ADD: REFER</span></strong></span></p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales_register_number_of_transactions as $key => $number_of_transactions)
                    @if ($number_of_transactions == 1)
                        <tr>
                            <td>
                                <input type="text" name="sales_register_or_number[{{ $key }}]"
                                    style="width:150px" class="form-control" required>
                            </td>
                            <td>{{ $sales_register_dr[$key] }}</td>
                            <td>{{ $sales_register_store_name[$key] }}</td>
                            <td>{{ $sales_register_principal[$key] }}</td>
                            <td>{{ $sales_register_sku_type[$key] }}</td>
                            <td>{{ $sales_register_mode_of_transaction[$key] }}</td>
                            <td>{{ $sales_register_total_amount[$key] }}</td>
                            <td>{{ $sales_register_amount_paid[$key] }}</td>
                            <td>{{ $sales_register_total_bo[$key] }}</td>
                            <td>{{ $sales_register_total_rgs[$key] }}</td>
                            <td>{{ $sales_register_balance[$key] }}</td>
                            <td>

                                <input type="text"
                                    style="text-align: right;    display: block;
                                width: 150px;
                                height: calc(2.25rem + 2px);
                                padding: 0.375rem 0.75rem;
                                font-size: 1rem;
                                font-weight: 400;
                                line-height: 1.5;
                                color: #495057;
                                background-color: #fff;
                                background-clip: padding-box;
                                border: 1px solid #ced4da;
                                border-radius: 0.25rem;
                                box-shadow: inset 0 0 0 transparent;
                                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_cash[{{ $key }}]" class="currency-default"
                                    value="0" required>
                            </td>
                            <td>
                                <input type="text"
                                    style="text-align: right;    display: block;
                                width: 150px;
                                height: calc(2.25rem + 2px);
                                padding: 0.375rem 0.75rem;
                                font-size: 1rem;
                                font-weight: 400;
                                line-height: 1.5;
                                color: #495057;
                                background-color: #fff;
                                background-clip: padding-box;
                                border: 1px solid #ced4da;
                                border-radius: 0.25rem;
                                box-shadow: inset 0 0 0 transparent;
                                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_cash_add_refer[{{ $key }}]" class="currency-default"
                                    value="0" required>
                            </td>
                            <td>

                                <input type="text"
                                    style="text-align: right;    display: block;
                                width: 150px;
                                height: calc(2.25rem + 2px);
                                padding: 0.375rem 0.75rem;
                                font-size: 1rem;
                                font-weight: 400;
                                line-height: 1.5;
                                color: #495057;
                                background-color: #fff;
                                background-clip: padding-box;
                                border: 1px solid #ced4da;
                                border-radius: 0.25rem;
                                box-shadow: inset 0 0 0 transparent;
                                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_cheque[{{ $key }}]" class="currency-default"
                                    value="0" required>
                            </td>
                            <td>
                                <input type="text"
                                    style="text-align: right;    display: block;
                                width: 150px;
                                height: calc(2.25rem + 2px);
                                padding: 0.375rem 0.75rem;
                                font-size: 1rem;
                                font-weight: 400;
                                line-height: 1.5;
                                color: #495057;
                                background-color: #fff;
                                background-clip: padding-box;
                                border: 1px solid #ced4da;
                                border-radius: 0.25rem;
                                box-shadow: inset 0 0 0 transparent;
                                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_cheque_add_refer[{{ $key }}]"
                                    class="currency-default" value="0" required>
                            </td>
                            <td>
                                <input type="text"
                                    style="text-align: right;    display: block;
                                width: 150px;
                                height: calc(2.25rem + 2px);
                                padding: 0.375rem 0.75rem;
                                font-size: 1rem;
                                font-weight: 400;
                                line-height: 1.5;
                                color: #495057;
                                background-color: #fff;
                                background-clip: padding-box;
                                border: 1px solid #ced4da;
                                border-radius: 0.25rem;
                                box-shadow: inset 0 0 0 transparent;
                                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_less_refer[{{ $key }}]" class="currency-default"
                                    value="0" required>
                            </td>

                            <td>
                                <input type="text" name="sales_register_specify[{{ $key }}]"
                                    style="width: 150px;" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="sales_register_remarks[{{ $key }}]"
                                    style="width: 150px;" class="form-control">

                                <input type="hidden" name="sales_register_store_name[{{ $key }}]"
                                    value="{{ $sales_register_store_name[$key] }}">
                                <input type="hidden" name="sales_register_balance[{{ $key }}]"
                                    value="{{ $sales_register_balance[$key] }}">
                                <input type="hidden" name="sales_register_principal[{{ $key }}]"
                                    value="{{ $sales_register_principal[$key] }}">
                                <input type="hidden" name="sales_register_sku_type[{{ $key }}]"
                                    value="{{ $sales_register_sku_type[$key] }}">
                                <input type="hidden" name="sales_register_mode_of_transaction[{{ $key }}]"
                                    value="{{ $sales_register_mode_of_transaction[$key] }}">
                                <input type="hidden" name="sales_register_total_amount[{{ $key }}]"
                                    value="{{ $sales_register_total_amount[$key] }}">
                                <input type="hidden" name="sales_register_total_bo[{{ $key }}]"
                                    value="{{ $sales_register_total_bo[$key] }}">
                                <input type="hidden" name="sales_register_total_rgs[{{ $key }}]"
                                    value="{{ $sales_register_total_rgs[$key] }}">
                                <input type="hidden" name="sales_register_amount_paid[{{ $key }}]"
                                    value="{{ $sales_register_amount_paid[$key] }}">
                                <input type="hidden" name="sales_register_dr[{{ $key }}]"
                                    value="{{ $sales_register_dr[$key] }}">
                                <input type="hidden" name="sales_register_id[{{ $key }}]"
                                    value="{{ $key }}">
                                <input type="hidden"
                                    name="sales_register_number_of_transactions[{{ $key }}]"
                                    value="{{ $number_of_transactions }}">
                            </td>
                        </tr>
                    @else
                        @php
                            $final_sales_register_number_of_transactions = $number_of_transactions - 1;
                        @endphp
                        <tr>
                            <td> <input type="text" name="sales_register_or_number[{{ $key }}]"
                                    style="width:150px;" class="form-control" required></td>
                            <td>{{ $sales_register_dr[$key] }}</td>
                            <td>{{ $sales_register_store_name[$key] }}</td>
                            <td>{{ $sales_register_principal[$key] }}</td>
                            <td>{{ $sales_register_sku_type[$key] }}</td>
                            <td>{{ $sales_register_mode_of_transaction[$key] }}</td>
                            <td>{{ $sales_register_total_amount[$key] }}</td>
                            <td>{{ $sales_register_amount_paid[$key] }}</td>
                            <td>{{ $sales_register_total_bo[$key] }}</td>
                            <td>{{ $sales_register_total_rgs[$key] }}</td>
                            <td>{{ $sales_register_balance[$key] }}</td>
                            <td>

                                <input type="text"
                                    style="text-align: right;    display: block;
                    width: 150px;
                    height: calc(2.25rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    box-shadow: inset 0 0 0 transparent;
                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_cash[{{ $key }}]" class="currency-default"
                                    value="0" required>
                            </td>
                            <td>
                                <input type="text"
                                    style="text-align: right;    display: block;
                    width: 150px;
                    height: calc(2.25rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    box-shadow: inset 0 0 0 transparent;
                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_cash_add_refer[{{ $key }}]"
                                    class="currency-default" value="0" required>
                            </td>
                            <td>

                                <input type="text"
                                    style="text-align: right;    display: block;
                    width: 150px;
                    height: calc(2.25rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    box-shadow: inset 0 0 0 transparent;
                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_cheque[{{ $key }}]" class="currency-default"
                                    value="0" required>
                            </td>
                            <td>
                                <input type="text"
                                    style="text-align: right;    display: block;
                    width: 150px;
                    height: calc(2.25rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    box-shadow: inset 0 0 0 transparent;
                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_cheque_add_refer[{{ $key }}]"
                                    class="currency-default" value="0" required>
                            </td>
                            <td>
                                <input type="text"
                                    style="text-align: right;    display: block;
                    width: 150px;
                    height: calc(2.25rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    box-shadow: inset 0 0 0 transparent;
                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                    name="sales_register_less_refer[{{ $key }}]" class="currency-default"
                                    value="0" required>
                            </td>
                            <td>
                                <input type="text" name="sales_register_specify[{{ $key }}]"
                                    style="width: 150px;" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="sales_register_remarks[{{ $key }}]"
                                    style="width: 150px;" class="form-control">

                                <input type="hidden" name="sales_register_store_name[{{ $key }}]"
                                    value="{{ $sales_register_store_name[$key] }}">
                                <input type="hidden" name="sales_register_balance[{{ $key }}]"
                                    value="{{ $sales_register_balance[$key] }}">
                                <input type="hidden" name="sales_register_principal[{{ $key }}]"
                                    value="{{ $sales_register_principal[$key] }}">
                                <input type="hidden" name="sales_register_sku_type[{{ $key }}]"
                                    value="{{ $sales_register_sku_type[$key] }}">
                                <input type="hidden" name="sales_register_mode_of_transaction[{{ $key }}]"
                                    value="{{ $sales_register_mode_of_transaction[$key] }}">
                                <input type="hidden" name="sales_register_total_amount[{{ $key }}]"
                                    value="{{ $sales_register_total_amount[$key] }}">
                                <input type="hidden" name="sales_register_total_bo[{{ $key }}]"
                                    value="{{ $sales_register_total_bo[$key] }}">
                                <input type="hidden" name="sales_register_total_rgs[{{ $key }}]"
                                    value="{{ $sales_register_total_rgs[$key] }}">
                                <input type="hidden" name="sales_register_amount_paid[{{ $key }}]"
                                    value="{{ $sales_register_amount_paid[$key] }}">
                                <input type="hidden" name="sales_register_dr[{{ $key }}]"
                                    value="{{ $sales_register_dr[$key] }}">
                                <input type="hidden" name="sales_register_id[{{ $key }}]"
                                    value="{{ $key }}">
                                <input type="hidden"
                                    name="sales_register_number_of_transactions[{{ $key }}]"
                                    value="{{ $number_of_transactions }}">
                            </td>
                        </tr>
                        @for ($i = 0; $i < $final_sales_register_number_of_transactions; $i++)
                            <tr>
                                <th colspan="12"></th>
                                <td>
                                    <input type="text"
                                        style="text-align: right;    display: block;
                    width: 150px;
                    height: calc(2.25rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    box-shadow: inset 0 0 0 transparent;
                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                        name="lower_sales_register_cash_add_refer[{{ $key . '-' . $i }}]"
                                        class="currency-default" value="0" required>
                                </td>
                                <td></td>
                                <td>
                                    <input type="text"
                                        style="text-align: right;    display: block;
                    width: 150px;
                    height: calc(2.25rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    box-shadow: inset 0 0 0 transparent;
                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                        name="lower_sales_register_cheque_add_refer[{{ $key . '-' . $i }}]"
                                        class="currency-default" value="0" required>
                                </td>
                                <td>
                                    <input type="text"
                                        style="text-align: right;    display: block;
                    width: 150px;
                    height: calc(2.25rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    box-shadow: inset 0 0 0 transparent;
                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                        name="lower_sales_register_less_refer[{{ $key . '-' . $i }}]"
                                        class="currency-default" value="0" required>
                                </td>
                                <td>
                                    <input type="text" name="lower_sales_register_specify[{{ $key . '-' . $i }}]"
                                        style="width: 150px;" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="lower_sales_register_remarks[{{ $key . '-' . $i }}]"
                                        style="width: 150px;" class="form-control">
                                </td>

                            </tr>
                        @endfor
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <input type="hidden" value="{{ $customer_id }}" name="customer_id">
    {{-- <input type="hidden" value="{{ $sales_register_number_of_transactions }}"
        name="sales_register_number_of_transactions"> --}}


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

    $("#collection_generate_final_summary").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "collection_generate_final_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                $('#collection_generate_final_summary_page').html(data);
            },
        });
    }));
</script>
