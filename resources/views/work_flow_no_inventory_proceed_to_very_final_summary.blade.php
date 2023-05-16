<style>
    .very_final_inventory th:first-child,
    .very_final_inventory td:first-child {
        position: sticky;
        left: 0px;
        background-color: antiquewhite;
    }
</style>


<form id="work_flow_no_inventory_save_previous_sales_register">

    <div class="table table-responsive">
        <table class="table table-bordered table-hover table-sm very_final_inventory table-striped"
            style="font-size:13px;">
            <thead>
                <tr>
                    <th colspan="4">Delivery Receipt: {{ $dr }}</th>
                </tr>
                <tr>
                    <th>Delivery Date</th>
                    <th colspan="3">{{ $delivery_date }}</th>
                </tr>
                <tr>
                    <th>Desc</th>
                    <th>Delivered QTY</th>
                    <th>U/P</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventory_data as $data)
                    <tr>
                        <td><b style="color:green">{{ $data->sku_code }}
                            </b><br /> {{ $data->description }}<br />
                            <b style="color:blue">{{ $data->sku_type }}</b>
                        </td>
                        <td>
                            {{ $current_sku_inventory[$data->id] }}
                            <input type="hidden" name="current_sku_inventory[{{ $data->id }}]"
                                value="{{ $current_sku_inventory[$data->id] }}">
                        </td>
                        <td style="text-align: right">
                            {{ number_format($unit_price[$data->id], 2, '.', ',') }}
                            <input type="hidden" class="form-control" name="unit_price[{{ $data->id }}]"
                                value="{{ $unit_price[$data->id] }}" style="width:100px;">
                            <input type="hidden" class="form-control" name="amount[{{ $data->id }}]"
                                value="{{ $unit_price[$data->id] * $current_sku_inventory[$data->id] }}"
                                style="width:100px;">
                            @php
                                $total = $current_sku_inventory[$data->id] * $unit_price[$data->id];
                                $gross[] = $total;
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Gross</th>
                    <th></th>
                    <th style="text-align: right">{{ number_format(array_sum($gross), 2, '.', ',') }}</th>
                </tr>
                <tr>
                    <th>Total Discount</th>
                    <th></th>
                    <th style="text-align: right">
                        {{ number_format($total_discount, 2, '.', ',') }}
                        <input type="hidden" class="form-control unit_price" name="total_discount" style="width:100px;"
                            value="{{ $total_discount }}">
                    </th>
                </tr>
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th style="text-align: right">
                        {{ number_format(array_sum($gross) - $total_discount, 2, '.', ',') }}
                        @php
                            $total_amount = array_sum($gross) - $total_discount;
                        @endphp
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <input type="hidden" name="customer_id" value="{{ $customer_id }}">
    <input type="hidden" name="total_amount" value="{{ $total_amount }}">
    <input type="hidden" name="dr" value="{{ $dr }}">
    <input type="hidden" name="principal_id" value="{{ $principal_id }}">
    <input type="hidden" name="sku_type" value="{{ $sku_type }}">
    <input type="hidden" name="date_delivered" value="{{ $delivery_date }}">
    <button class="btn btn-success btn-block">SUBMIT</button>
</form>

<script>
    $('.unit_price').keyup(function() {
        var val = $(this).val();
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.+$/, "");
        }
        $(this).val(val);
    });

    $("#work_flow_no_inventory_save_previous_sales_register").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "work_flow_no_inventory_save_previous_sales_register",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == "saved") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.href = "/work_flow";
                } else {
                    alert('saved');
                }
            },
        });
    }));
</script>
