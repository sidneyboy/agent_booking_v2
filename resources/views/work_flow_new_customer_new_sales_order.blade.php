<form id="work_flow_new_customer_final_summary">

    <div class="form-group">
        <label>Price Level</label>
        <select name="price_level" class="form-control" required>
            <option value="" default>SELECT PRICE LEVEL</option>
            <option value="price_1">Price 1</option>
            <option value="price_2">Price 2</option>
            <option value="price_3">Price 3</option>
            <option value="price_4">Price 4</option>
            <option value="price_5">Price 5</option>
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

        <label>Detailed Address</label>
        <input type="text" class="form-control" name="detailed_address" required>

        <label>Longitude</label>
        <input type="text" class="form-control" name="longitude" id="longitude" required>

        <label>Latitude</label>
        <input type="text" class="form-control" name="latitude" id="latitude" required>


        <input type="hidden" value="{{ $agent_user->agent_name }}" name="agent_name">
    </div>
    <br />
    <div class="table table-responsive">
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
                @foreach ($inventory_data as $data)
                    <tr>
                        <td>
                            {{ $data->description }} <br />
                            {{ $data->sku_type }}
                        </td>
                        <td><input style="width:100px;" name="new_sales_order_inventory_quantity[{{ $data->id }}]"
                                type="number" min="0" value="0" required class="form-control"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <input type="hidden" value="{{ $principal_id }}" name="principal_id">
    <input type="hidden" value="{{ $sku_type }}" name="sku_type">
    <button class="btn btn-block btn-info" type="submit">Proceed</button>
</form>

<script>
    $(document).ready(function() {
        // function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        // }

        function showPosition(position) {
            // x.innerHTML = "Latitude: " + position.coords.latitude +
            //     "<br>Longitude: " + position.coords.longitude;

            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
        }
    });

    $("#work_flow_new_customer_final_summary").on('submit', (function(e) {
        e.preventDefault();
        $('.loading').show();
        $.ajax({
            url: "work_flow_new_customer_final_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                $('#work_flow_final_summary_page').html(data);
            },
            error: function(error) {
                $('.loading').hide();
                Swal.fire(
                    'Cannot Proceed',
                    'Please Contact IT Support',
                    'error'
                )
            }
        });
    }));
</script>
