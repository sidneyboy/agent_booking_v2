<form id="work_flow_no_inventory_proceed_to_final_summary">
    @csrf
    <div class="table table-responsive">
        <table class="table table-sm table-bordered striped" id="example2" style="font-size:13px;">
            <thead>
                <tr>
                    <th colspan="2" style="color:blue;">CUSTOMER PREVIOUS SALES ORDER</th>
                </tr>
                <tr>
                    <th>Sales Order Delivery Date: </th>
                    <th><input type="date" class="form-control" name="delivery_date" required style="width:100%;">
                    </th>
                </tr>
                <tr>
                    <th>Desc</th>
                    <th>Delivered QTY</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales_order_inventory as $data)
                    <tr>
                        <td>
                            <b style="color:green">{{ $data->sku_code }}</b><br />
                            {{ $data->description }} <br />
                            <b style="color:blue;">{{ $data->sku_type }}</b>
                        </td>
                        <td><input type="number" style="text-align: center;" min="0"
                                class="form-control form-control-sm" value="0"
                                name="delivered_quantity[{{ $data->id }}]"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <input type="hidden" value="{{ $customer_id }}" name="customer_id">
    <input type="hidden" value="{{ $principal_id }}" name="principal_id">
    <input type="hidden" value="{{ $sku_type }}" name="sku_type">
    </div>
    <button class="btn btn-block btn-info" type="submit">PROCEED</button>
</form>

<script>
    $('.select2').select2();
    $("#work_flow_no_inventory_proceed_to_final_summary").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "work_flow_no_inventory_proceed_to_final_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                $('#work_flow_suggested_sales_order_page').html(data);
            },
        });
    }));

    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        // "scrollY": '300px',
        // "scrollCollapse": false,
    });
</script>
