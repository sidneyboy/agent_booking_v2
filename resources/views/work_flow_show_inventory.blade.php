<form id="work_flow_suggested_sales_order">
    @csrf
    <div class="table table-responsive">
        <table class="table table-sm table-bordered table-striped" style="font-size:13px;">
            <thead>
                <tr>
                    <th colspan="3" style="color:blue;">CUSTOMER WAREHOUSE INVENTORY COUNT</th>
                </tr>
                <tr>
                    <th>Desc</th>
                    <th>BO</th>
                    <th>Remaining</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales_register->sales_register_details as $data)
                    <tr>
                        <td>
                            <b style="color:blue;">{{ $data->inventory->sku_code }}</b><br />
                            {{ $data->inventory->description }} <br />
                            <b style="color:green">{{ $data->sku_type }}</b>
                            <input type="hidden" name="current_inventory_id[]" value="{{ $data->inventory_id }}">
                            <input type="hidden" name="current_inventory_description[{{ $data->inventory_id }}]"
                                value="{{ $data->inventory->description }}">
                            <input type="hidden" name="current_inventory_unit_price[{{ $data->inventory_id }}]"
                                value="{{ $data->unit_price }}">
                        </td>
                        <td>
                            <input style="width:100px;text-align:center;" name="current_bo[{{ $data->inventory_id }}]"
                                type="number" min="0" value="0" required class="form-control">

                        </td>
                        <td>
                            <input style="width:100px;text-align:center;"
                                name="current_remaining_inventory[{{ $data->inventory_id }}]" type="number"
                                min="0" value="0" required class="form-control">
                            <input type="hidden" name="prev_delivered_inventory[{{ $data->inventory_id }}]"
                                value="{{ $data->delivered_quantity }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <input type="hidden" value="{{ $customer_id }}" name="customer_id">
    <input type="hidden" value="{{ $principal_id }}" name="principal_id">
    <input type="hidden" value="{{ $sku_type }}" name="sku_type">
    <input type="hidden" value="{{ $sales_register->date_delivered }}" name="date_delivered">
    <input type="hidden" value="{{ $sales_register->id }}" name="sales_register_id">
    <button class="btn btn-block btn-info" type="submit">PROCEED</button>
</form>


<script>
    $("#work_flow_suggested_sales_order").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();

        Swal.fire({
            title: 'Save as draft ?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "work_flow_inventory_save_as_draft",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('.loading').hide();
                        if (data == 'saved') {
                            Swal.fire(
                                'Work saved to Draft',
                                '',
                                'success'
                            )
                            window.location.href = "/work_flow";
                        }

                    },
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }));
</script>
