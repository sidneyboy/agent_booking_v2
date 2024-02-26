<style>
    #final_summary td:first-child {
        position: sticky;
        left: 0px;
        background-color: antiquewhite;
    }

    /* #final_summary th:nth-child(3),
    #final_summary td:nth-child(3) {
        position: sticky;
        left: 0px;
        background-color: antiquewhite;
    } */
</style>
<form id="collection_save">
    <div class="table table-responsive">
        <table class="table table-bordered table-sm" id="final_summary">
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
                    <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
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
                        Balance
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
                            <td>{{ $sales_register_or_number[$key] }}</td>
                            <td>{{ $sales_register_dr[$key] }}</td>
                            <td>{{ $sales_register_store_name[$key] }}</td>
                            <td>{{ $sales_register_principal[$key] }}</td>
                            <td>{{ $sales_register_sku_type[$key] }}</td>
                            <td>{{ $sales_register_mode_of_transaction[$key] }}</td>
                            <td>{{ number_format($sales_register_total_amount[$key], 2, '.', ',') }}</td>
                            <td>{{ number_format($sales_register_amount_paid[$key], 2, '.', ',') }}</td>
                            <td>{{ number_format($sales_register_total_bo[$key], 2, '.', ',') }}</td>
                            <td>{{ number_format($sales_register_total_rgs[$key], 2, '.', ',') }}</td>
                            <td>{{ number_format($sales_register_balance[$key], 2, '.', ',') }}</td>
                            <td>
                                {{ number_format($sales_register_cash[$key], 2, '.', ',') }}
                                @php
                                    $total_sales_register_cash[] = $sales_register_cash[$key];
                                @endphp
                            </td>
                            <td>
                                {{ number_format($sales_register_cash_add_refer[$key], 2, '.', ',') }}
                                @php
                                    $total_sales_register_cash_add_refer[] = $sales_register_cash_add_refer[$key];
                                @endphp
                            </td>
                            <td>
                                {{ number_format($sales_register_cheque[$key], 2, '.', ',') }}
                                @php
                                    $total_sales_register_cheque[] = $sales_register_cheque[$key];
                                @endphp
                            </td>
                            <td>
                                {{ number_format($sales_register_cheque_add_refer[$key], 2, '.', ',') }}
                                @php
                                    $total_sales_register_cheque_add_refer[] = $sales_register_cheque_add_refer[$key];
                                @endphp
                            </td>
                            <td>
                                {{ number_format($sales_register_less_refer[$key], 2, '.', ',') }}
                                @php
                                    $total_sales_register_less_refer[] = $sales_register_less_refer[$key];
                                @endphp
                            </td>
                            <td>
                                {{-- @php
                                    $discount_value_holder_dummy = $discount_value_holder;
                                    
                                    $discount_value_holder = $sales_register_balance[$key]  - $sales_register_cash[$key] - $sales_register_cash_add_refer[$key] - $sales_register_cheque[$key] - $sales_register_cheque_add_refer[$key] + $sales_register_less_refer[$key];;
                                    $discount_holder[] = $discount_value_holder;
                                    echo number_format($discount_value_holder, 2, '.', ',');
                                    
                                @endphp
                                <input type="hidden" name="sales_register_updated_balance[{{ $key }}]" value="{{ $discount_value_holder }}"> --}}
                                @php
                                    $sales_register_final_balance = $sales_register_balance[$key] - $sales_register_cash[$key] - $sales_register_cash_add_refer[$key] - $sales_register_cheque[$key] - $sales_register_cheque_add_refer[$key] + $sales_register_less_refer[$key];
                                    echo number_format($sales_register_final_balance, 2, '.', ',');
                                @endphp
                                <input type="hidden" name="sales_register_updated_balance[{{ $key }}]"
                                    value="{{ $sales_register_final_balance }}">
                            </td>
                            <td>{{ $sales_register_specify[$key] }}</td>
                            <td>{{ $sales_register_remarks[$key] }}
                                <input type="hidden" value="{{ $sales_register_or_number[$key] }}"
                                    name="sales_register_or_number[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_dr[$key] }}"
                                    name="sales_register_dr[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_store_name[$key] }}"
                                    name="sales_register_store_name[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_principal[$key] }}"
                                    name="sales_register_principal[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_sku_type[$key] }}"
                                    name="sales_register_sku_type[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_mode_of_transaction[$key] }}"
                                    name="sales_register_mode_of_transaction[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_total_amount[$key] }}"
                                    name="sales_register_total_amount[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_amount_paid[$key] }}"
                                    name="sales_register_amount_paid[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_total_bo[$key] }}"
                                    name="sales_register_total_bo[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_total_rgs[$key] }}"
                                    name="sales_register_total_rgs[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_balance[$key] }}"
                                    name="sales_register_balance[{{ $key }}]">
                                <input type="hidden" value="{{ $number_of_transactions }}"
                                    name="sales_register_number_of_transactions[{{ $key }}]">


                                <input type="hidden" value="{{ $sales_register_cash[$key] }}"
                                    name="sales_register_cash[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_cash_add_refer[$key] }}"
                                    name="sales_register_cash_add_refer[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_cheque[$key] }}"
                                    name="sales_register_cheque[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_cheque_add_refer[$key] }}"
                                    name="sales_register_cheque_add_refer[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_less_refer[$key] }}"
                                    name="sales_register_less_refer[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_specify[$key] }}"
                                    name="sales_register_specify[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_remarks[$key] }}"
                                    name="sales_register_remarks[{{ $key }}]">


                                @php
                                    $total_lower_sales_register_cash_add_refer[] = 0;
                                    $total_lower_sales_register_cheque_add_refer[] = 0;
                                    $total_lower_sales_register_less_refer[] = 0;
                                @endphp

                            </td>
                        </tr>
                    @else
                        @php
                            $total = $sales_register_total_amount[$key];
                            $discount_holder = [];
                            $discount_value_holder = $total;
                        @endphp
                        <tr>
                            <td>
                                {{ $sales_register_or_number[$key] }}
                                <input type="hidden" value="{{ $sales_register_or_number[$key] }}"
                                    name="sales_register_or_number[{{ $key }}]">
                            </td>
                            <td>
                                {{ $sales_register_dr[$key] }}
                                <input type="hidden" value="{{ $sales_register_dr[$key] }}"
                                    name="sales_register_dr[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_store_name[$key] }}"
                                    name="sales_register_store_name[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_principal[$key] }}"
                                    name="sales_register_principal[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_sku_type[$key] }}"
                                    name="sales_register_sku_type[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_mode_of_transaction[$key] }}"
                                    name="sales_register_mode_of_transaction[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_total_amount[$key] }}"
                                    name="sales_register_total_amount[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_amount_paid[$key] }}"
                                    name="sales_register_amount_paid[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_total_bo[$key] }}"
                                    name="sales_register_total_bo[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_total_rgs[$key] }}"
                                    name="sales_register_total_rgs[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_balance[$key] }}"
                                    name="sales_register_balance[{{ $key }}]">
                                <input type="hidden" value="{{ $number_of_transactions }}"
                                    name="sales_register_number_of_transactions[{{ $key }}]">


                                <input type="hidden" value="{{ $sales_register_cash[$key] }}"
                                    name="sales_register_cash[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_cash_add_refer[$key] }}"
                                    name="sales_register_cash_add_refer[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_cheque[$key] }}"
                                    name="sales_register_cheque[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_cheque_add_refer[$key] }}"
                                    name="sales_register_cheque_add_refer[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_less_refer[$key] }}"
                                    name="sales_register_less_refer[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_specify[$key] }}"
                                    name="sales_register_specify[{{ $key }}]">
                                <input type="hidden" value="{{ $sales_register_remarks[$key] }}"
                                    name="sales_register_remarks[{{ $key }}]">


                            </td>
                            <td>{{ $sales_register_store_name[$key] }}</td>
                            <td>{{ $sales_register_principal[$key] }}</td>
                            <td>{{ $sales_register_sku_type[$key] }}</td>
                            <td>{{ $sales_register_mode_of_transaction[$key] }}</td>
                            <td>{{ number_format($sales_register_total_amount[$key], 2, '.', ',')  }}</td>
                            <td>{{ number_format($sales_register_amount_paid[$key], 2, '.', ',')  }}</td>
                            <td>{{ number_format($sales_register_total_bo[$key], 2, '.', ',')  }}</td>
                            <td>{{ number_format($sales_register_total_rgs[$key], 2, '.', ',')  }}</td>
                            <td>{{ number_format($sales_register_balance[$key], 2, '.', ',')  }}</td>
                            <td>
                                {{ number_format($sales_register_cash[$key], 2, '.', ',')  }}
                                @php
                                    $total_sales_register_cash[] = $sales_register_cash[$key];
                                @endphp
                            </td>
                            <td>
                                {{ number_format($sales_register_cash_add_refer[$key], 2, '.', ',')  }}
                                @php
                                    $total_sales_register_cash_add_refer[] = $sales_register_cash_add_refer[$key];
                                @endphp
                            </td>
                            <td>
                                {{ number_format($sales_register_cheque[$key], 2, '.', ',')  }}
                                @php
                                    $total_sales_register_cheque[] = $sales_register_cheque[$key];
                                @endphp
                            </td>
                            <td>
                                {{ number_format($sales_register_cheque_add_refer[$key], 2, '.', ',')  }}
                                @php
                                    $total_sales_register_cheque_add_refer[] = $sales_register_cheque_add_refer[$key];
                                @endphp
                            </td>
                            <td>
                                {{ number_format($sales_register_less_refer[$key], 2, '.', ',')  }}
                                @php
                                    $total_sales_register_less_refer[] = $sales_register_less_refer[$key];
                                @endphp
                            </td>
                            <td>
                                @php
                                    $discount_value_holder_dummy = $discount_value_holder;

                                    $discount_value_holder = $sales_register_balance[$key] - $sales_register_cash[$key] - $sales_register_cash_add_refer[$key] - $sales_register_cheque[$key] - $sales_register_cheque_add_refer[$key] + $sales_register_less_refer[$key];
                                    $discount_holder[] = $discount_value_holder;
                                    echo number_format($discount_value_holder, 2, '.', ',');

                                @endphp
                                <input type="hidden" name="sales_register_updated_balance[{{ $key }}]"
                                    value="{{ $discount_value_holder }}">
                            </td>
                            <td>{{ $sales_register_specify[$key] }}</td>
                            <td>{{ $sales_register_remarks[$key] }}</td>
                        </tr>
                        @php
                            $final_sales_register_number_of_transactions = $number_of_transactions - 1;
                        @endphp

                        @for ($i = 0; $i < $final_sales_register_number_of_transactions; $i++)
                            @php
                                $total_2 = array_sum($discount_holder);
                                $discount_holder_2 = [];
                                $discount_value_holder_2 = $total_2;
                            @endphp
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    {{ number_format($lower_sales_register_cash_add_refer[$key .'-'. $i], 2, '.', ',') }}
                                    @php
                                        $total_lower_sales_register_cash_add_refer[] = $lower_sales_register_cash_add_refer[$key . '-' . $i];
                                    @endphp
                                </td>
                                <td></td>
                                <td>
                                    {{ number_format($lower_sales_register_cheque_add_refer[$key .'-'. $i], 2, '.', ',') }}
                                    @php
                                        $total_lower_sales_register_cheque_add_refer[] = $lower_sales_register_cheque_add_refer[$key . '-' . $i];
                                    @endphp
                                </td>
                                <td>
                                    {{ number_format($lower_sales_register_less_refer[$key .'-'. $i], 2, '.', ',') }}
                                    @php
                                        $total_lower_sales_register_less_refer[] = $lower_sales_register_less_refer[$key . '-' . $i];
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $discount_value_holder_dummy_2 = $discount_value_holder_2;

                                        $discount_value_holder_2 = $discount_value_holder_dummy_2 - $lower_sales_register_cash_add_refer[$key . '-' . $i] - $lower_sales_register_cheque_add_refer[$key . '-' . $i] + $lower_sales_register_less_refer[$key . '-' . $i];
                                        $discount_holder_2[] = $discount_value_holder_2;
                                        echo number_format($discount_value_holder_2, 2, '.', ',');
                                    @endphp
                                    <input type="hidden"
                                        name="lower_sales_register_updated_balance[{{ $key . '-' . $i }}]"
                                        value="{{ $discount_value_holder_2 }}">
                                </td>
                                <td>{{ $lower_sales_register_specify[$key . '-' . $i] }}</td>
                                <td>
                                    {{ $lower_sales_register_remarks[$key . '-' . $i] }}

                                    <input type="hidden"
                                        value="{{ $lower_sales_register_cash_add_refer[$key . '-' . $i] }}"
                                        name="lower_sales_register_cash_add_refer[{{ $key . '-' . $i }}]">
                                    <input type="hidden"
                                        value="{{ $lower_sales_register_cheque_add_refer[$key . '-' . $i] }}"
                                        name="lower_sales_register_cheque_add_refer[{{ $key . '-' . $i }}]">

                                    <input type="hidden"
                                        value="{{ $lower_sales_register_less_refer[$key . '-' . $i] }}"
                                        name="lower_sales_register_less_refer[{{ $key . '-' . $i }}]">

                                    <input type="hidden"
                                        value="{{ $lower_sales_register_specify[$key . '-' . $i] }}"
                                        name="lower_sales_register_specify[{{ $key . '-' . $i }}]">

                                    <input type="hidden"
                                        value="{{ $lower_sales_register_remarks[$key . '-' . $i] }}"
                                        name="lower_sales_register_remarks[{{ $key . '-' . $i }}]">
                                </td>
                            </tr>
                        @endfor
                    @endif
                @endforeach
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th colspan="10">TOTAL</th>
                    <th>{{ number_format(array_sum($total_sales_register_cash), 2, '.', ',') }}</th>
                    <th>{{ number_format(array_sum($total_sales_register_cash_add_refer) + array_sum($total_lower_sales_register_cash_add_refer), 2, '.', ',') }}
                    </th>
                    <th>{{ number_format(array_sum($total_sales_register_cheque), 2, '.', ',') }}</th>
                    <th>{{ number_format(array_sum($total_sales_register_cheque_add_refer) + array_sum($total_lower_sales_register_cheque_add_refer), 2, '.', ',') }}
                    </th>
                    <th>{{ number_format(array_sum($total_sales_register_less_refer) + array_sum($total_lower_sales_register_less_refer), 2, '.', ',') }}
                    </th>
                </tr>
            </tfoot> --}}
        </table>
    </div>
    <input type="hidden" name="customer_id" value="{{ $customer_id }}">
    <button type="submit" class="btn btn-block btn-success">Submit</button>
</form>

<script>
    $("#collection_save").on('submit', (function(e) {
        e.preventDefault();
        $('.loading').show();
        $.ajax({
            url: "collection_save",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                Swal.fire(
                 'Successfully Submitted Collection',
                'Redirecting To Work Flow',
                'success'
                );

                 window.location.href = "/collection_export";
            },
        });
    }));
</script>
