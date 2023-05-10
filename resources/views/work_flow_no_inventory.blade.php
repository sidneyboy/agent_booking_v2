{{-- <style>
    .current_inventory th:first-child,
    .current_inventory td:first-child {
        position: sticky;
        left: 0px;
        background-color: antiquewhite;
    }
</style> --}}

<form id="work_flow_no_inventory_proceed_to_final_summary">
    @csrf
    {{-- <div class="form-group">
        @if (!isset($customer_principal_price))
            <label>Price Level</label>
            <select name="price_level" class="form-control" required>
                <option value="" default>SELECT PRICE LEVEL</option>
                <option value="price_1">Price 1</option>
                <option value="price_2">Price 2</option>
                <option value="price_3">Price 3</option>
                <option value="price_4">Price 4</option>
            </select>
        @else
            <label>Price Level</label>
            <select name="price_level" class="form-control" required>
                <option value="" default>SELECT PRICE LEVEL</option>
                <option value="price_1">Price 1</option>
                <option value="price_2">Price 2</option>
                <option value="price_3">Price 3</option>
                <option value="price_4">Price 4</option>
                <option value="{{ $customer_principal_price->price_level }}" name>{{ $customer_principal_price->price_level }}</option>
            </select>
        @endif

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

        <label>Mode of Transaction</label>
        <select name="mode_of_transaction" class="form-control select2" required>
            <option value="" default>Select</option>
            <option value="COD">COD</option>
            <option value="PDC">PDC</option>
            <option value="VALE">VALE</option>
            <option value="{{ $customer->mode_of_transaction }}" selected>{{ $customer->mode_of_transaction }}</option>
        </select>

        <label>Store Name</label>
        <input type="text" class="form-control" name="store_name" value="{{ $customer->store_name }}" required>

        <label>Contact Person</label>
        <input type="text" class="form-control" name="contact_person" value="{{ $customer->contact_person }}"
            required>

        <label>Contact Number</label>
        <input type="number" min="0" class="form-control" name="contact_number"
            value="{{ $customer->contact_number }}" required>

        <label>Location</label>
        <select name="location_id" id="" class="form-control select2" style="width:100%;" required>
            <option value="" default>Select</option>
            @foreach ($location as $data)
                <option value="{{ $data->id . '-' . $data->location }}">{{ $data->location }}</option>
            @endforeach
            <option value="{{ $customer->location_id ." - ". $customer->location->location }}" selected>{{ $customer->location->location }}</option>
        </select>

        <label>Detailed Addres</label>
        <input type="text" class="form-control" name="detailed_address" value="{{ $customer->detailed_address }}"
            required>

        <label>Longitude</label>
        <input type="text" class="form-control" name="longitude" value="{{ $customer->longitude }}" required>

        <label>Latitude</label>
        <input type="text" class="form-control" name="latitude" value="{{ $customer->latitude }}" required>

        <input type="hidden" value="{{ $agent_user->agent_name }}" name="agent_name">
    </div> --}}
    <div class="table table-responsive">
        <table class="table table-sm table-bordered" id="example2">
            <thead>
                <tr>
                    <th colspan="2">Current Inventory</th>
                </tr>
                <tr>
                    <td>Delivery Date</td>
                    <td><input type="date" class="form-control" required name="delivery_date"></th>
                </tr>
                <tr>
                    <th>Desc</th>
                    <th>Delivered QTY</th>
                    {{-- <th>U/P</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($sales_order_inventory as $data)
                    <tr>
                        <td>
                            {{ $data->description }} <br />
                            {{ $data->sku_type }}
                        </td>
                        <td><input type="number" min="0" class="form-control" value="0"
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
                // $('#work_flow_suggested_sales_order_page').hide();
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
    });
</script>
