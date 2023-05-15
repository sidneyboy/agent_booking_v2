{{-- <style>
    .current_inventory th:first-child,
    .current_inventory td:first-child {
        position: sticky;
        left: 0px;
        background-color: antiquewhite;
    }
</style> --}}


<form id="work_flow_no_inventory_proceed_to_very_final_summary">
    <input type="text" class="form-control form-control-sm" name="dr" required placeholder="Delivery Receipt">
    <br />
    <div class="table table-responsive">
        <table class="table table-bordered table-hover table-striped table-sm current_inventory" style="font-size:13px;">
            <thead>
                <tr>
                    <th>Delivery Date:</th>
                    <th colspan="3" style="text-align: center;">{{ $delivery_date }}</th>
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
                        <td>
                            <b style="color:green">{{ $data->sku_code }}</b><br />
                            {{ $data->description }}<br />
                            <b style="color:blue;">{{ $data->sku_type }}</b>
                        </td>
                        <td style="text-align: right">
                            {{ $current_sku_inventory[$data->id] }}
                            <input type="hidden" name="current_sku_inventory[{{ $data->id }}]"
                                value="{{ $current_sku_inventory[$data->id] }}">
                        </td>
                        <td><input type="text" class="form-control unit_price form-control-sm" name="unit_price[{{ $data->id }}]"
                                style="width:100px;text-align:center;"></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total Discount</th>
                    <td></td>
                    <td><input type="text" class="form-control unit_price" name="total_discount"
                            style="width:100px;text-align:center;"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <input type="hidden" name="customer_id" value="{{ $customer_id }}">
    <input type="hidden" name="principal_id" value="{{ $principal_id }}">
    <input type="hidden" name="sku_type" value="{{ $sku_type }}">
    <input type="hidden" name="delivery_date" value="{{ $delivery_date }}">
    <button class="btn btn-info btn-block">PROCEED</button>
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

    $("#work_flow_no_inventory_proceed_to_very_final_summary").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "work_flow_no_inventory_proceed_to_very_final_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                // $('#work_flow_suggested_sales_order_page').hide();
                $('#work_flow_final_summary_page').html(data);
            },
        });
    }));
</script>
