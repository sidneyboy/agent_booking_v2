<div class="table table-responsive">
    <table class="table table-bordered table-sm" id="export_table">
        <thead>
            <tr>
                <td>SALESMAN</td>
                <td colspan="2">{{ $agent_user->agent_name }}</td>
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
                <td></td>
                <td></td>
            </tr>
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
                    T-BO
                </th>
                <th rowspan="2" style="vertical-align: middle;font-weight:bold;text-align:center">
                    T-RGS
                </th>
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
        </thead>
        <tbody>
            @foreach ($collection as $data)
                <tr>
                    <td>{{ $data->or_number }}</td>
                    <td>{{ $data->dr }}</td>
                    <td>{{ $data->customer->store_name }}</td>
                    <td>{{ $data->principal }}</td>
                    <td>{{ $data->sku_type }}</td>
                    <td>{{ $data->mode_of_transaction }}</td>
                    <td>{{ $data->total_amount}}</td>
                    <td>{{ $data->total_bo}}</td>
                    <td>{{ $data->total_rgs}} </td>
                    <td style="text-align: right">
                        {{ $data->collection_details_first->cash}}
                        @php
                            $upper_cash_total[] = $data->collection_details_first->cash;
                        @endphp
                    </td>
                    <td style="text-align: right">
                        {{ $data->collection_details_first->cash_add_refer}}
                        @php
                            $upper_cash_add_refer[] = $data->collection_details_first->cash_add_refer;
                        @endphp
                    </td>
                    <td style="text-align: right">
                        {{ $data->collection_details_first->cheque}}
                        @php
                            $upper_cheque[] = $data->collection_details_first->cheque;
                        @endphp
                    </td>
                    <td style="text-align: right">
                        {{ $data->collection_details_first->cheque_add_refer}}
                        @php
                            $upper_cheque_add_refer[] = $data->collection_details_first->cheque_add_refer;
                        @endphp
                    </td>
                    <td style="text-align: right">
                        {{ $data->collection_details_first->less_refer}}
                        @php
                            $upper_less_refer[] = $data->collection_details_first->less_refer;
                        @endphp
                    </td>
                    <td style="text-align: right">
                        {{ $data->collection_details_first->balance}}
                    </td>
                    <td>{{ $data->collection_details_first->specify }}</td>
                    <td>{{ $data->collection_details_first->remarks }}</td>
                </tr>
                @foreach ($data->collection_details as $details)
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
                        <td style="text-align: right">
                            {{ $details->cash_add_refer}}
                            @php
                                $lower_cash_add_refer[] = $data->collection_details_first->cash_add_refer;
                            @endphp
                        </td>
                        <td style="text-align: right"></td>
                        <td style="text-align: right">
                            {{ $details->cheque_add_refer}}
                            @php
                                $lower_cheque_add_refer[] = $data->collection_details_first->cheque_add_refer;
                            @endphp
                        </td>
                        <td style="text-align: right">
                            {{ $details->less_refer}}
                            @php
                                $lower_less_refer[] = $data->collection_details_first->less_refer;
                            @endphp
                        </td>
                        <td>{{ $details->balance}}</td>
                        <td>{{ $details->specify }}</td>
                        <td>{{ $details->remarks }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        {{-- <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ array_sum($upper_cash_total) }}</td>
                <td>{{ array_sum($upper_cash_add_refer) + array_sum($lower_cash_add_refer) }}</td>
                <td>{{ array_sum($upper_cheque) }}</td>
                <td>{{ array_sum($upper_cheque_add_refer) + array_sum($lower_cheque_add_refer) }}</td>
                <td>{{ array_sum($upper_less_refer) + array_sum($lower_less_refer) }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot> --}}
    </table>
</div>


<br />

<button
    onclick="exportTableToCSV('{{ $agent_user->agent_name }} - LOCPD - {{ $date_from }} - {{ $date_to }}.csv')"
    class="btn btn-success btn-block btn-sm">Export LOCPD</button>


