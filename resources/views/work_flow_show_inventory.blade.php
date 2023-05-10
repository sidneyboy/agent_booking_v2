<form id="work_flow_suggested_sales_order">
    @csrf
    {{-- asdasdasdasd --}}
    {{-- <div class="form-group">
        <label>Price Level</label>
        <select name="price_level" class="form-control" required>
            <option value="" default>SELECT PRICE LEVEL</option>
            <option value="price_1">Price 1</option>
            <option value="price_2">Price 2</option>
            <option value="price_3">Price 3</option>
            <option value="price_4">Price 4</option>
        </select>

        <label>Kind of Business</label>
        <select name="kob" class="form-control select2" required>
            <option value="" default>Select</option>
            <option value="SSS">SSS</option>
            <option value="GRO">GRO</option>
            <option value="SM">SM</option>
            <option value="DS">DS</option>
            <option value="PMS">PMS</option>
            <option value="CNV">CNV</option>
            <option value="HWA">HWA</option>
            <option value="WS">WS</option>
            <option value="HLS">HLS</option>
            <option value="TER">TER</option>
            <option value="INST">INST</option>
            <option value="{{ $customer->kob }}" selected>{{ $customer->kob }}</option>
        </select>

        <label>Store Name</label>
        <input type="text" class="form-control" name="store_name" required>

        <label>Contact Person</label>
        <input type="text" class="form-control" name="contact_person" required>

        <label>Contact Number</label>
        <input type="number" min="0" class="form-control" name="contact_number" required>

        <label>Location</label>
        <select name="location" id="" class="form-control select2" style="width:100%;">
            <option value="" default>Select</option>
            @foreach ($location as $data)
                <option value="{{ $data->id . '-' . $data->location }}">{{ $data->location }}</option>
            @endforeach
        </select>

        <label>Detailed Addres</label>
        <input type="text" class="form-control" name="detailed_address" required>

        <label>Longitude</label>
        <input type="text" class="form-control" name="longitude" required>

        <label>Latitude</label>
        <input type="text" class="form-control" name="latitude" required>

        <input type="hidden" value="{{ $agent_user->agent_name }}" name="agent_name">
    </div> --}}

    <div class="table table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th colspan="3">Warehouse Inventory</th>
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
                            {{ $data->inventory->description }} <br />
                            {{ $data->sku_type }}
                            <input type="hidden" name="current_inventory_id[]" value="{{ $data->inventory_id }}">
                            <input type="hidden" name="current_inventory_description[{{ $data->inventory_id }}]"
                                value="{{ $data->inventory->description }}">
                            <input type="hidden" name="current_inventory_unit_price[{{ $data->inventory_id }}]"
                                value="{{ $data->unit_price }}">
                        </td>
                        <td>
                            <input style="width:100px;" name="current_bo[{{ $data->inventory_id }}]" type="number"
                                min="0" value="0" required class="form-control">

                        </td>
                        <td>
                            <input style="width:100px;" name="current_remaining_inventory[{{ $data->inventory_id }}]"
                                type="number" min="0" value="0" required class="form-control">
                            <input type="hidden" name="prev_delivered_inventory[{{ $data->inventory_id }}]"
                                value="{{ $data->delivered_quantity }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div class="table table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th colspan="3">New Sales Order</th>
                </tr>
                <tr>
                    <th>Desc</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales_order_inventory as $data)
                    <tr>
                        <td>
                            {{ $data->description }} <br />
                            {{ $data->sku_type }}
                            <input type="hidden" name="new_sales_order_inventory_id[]" value="{{ $data->id }}">
                            <input type="hidden" name="new_sales_order_inventory_description[{{ $data->id }}]"
                                value="{{ $data->description }}">
                        </td>
                        <td><input style="width:100px;" name="new_sales_order_inventory_quantity[{{ $data->id }}]"
                                type="number" min="0" value="0" required class="form-control"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
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
            /* Read more about isConfirmed, isDenied below */
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
                            window.location.href = "/collection";
                        }
                        
                    },
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })



        // $.ajax({
        //     url: "work_flow_suggested_sales_order",
        //     type: "POST",
        //     data: new FormData(this),
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     success: function(data) {
        //         $('.loading').hide();
        //         $('#work_flow_suggested_sales_order_page').html(data);
        //     },
        // });
    }));
</script>
