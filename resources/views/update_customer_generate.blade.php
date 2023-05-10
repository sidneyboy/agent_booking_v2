<form id="update_customer_generate_page_final_summary" method="post">
    @csrf
    <div class="form-group">
        @if (isset($customer_principal_price))
            @foreach ($customer_principal_price as $data)
                <label>{{ $data->principal->principal }}</label>
                <select name="customer_principal_price_level[]" class="form-control" required>
                    <option value="{{ $data->principal->principal }}-{{ $data->principal_id }}-price_1">price_1</option>
                    <option value="{{ $data->principal->principal }}-{{ $data->principal_id }}-price_2">price_2</option>
                    <option value="{{ $data->principal->principal }}-{{ $data->principal_id }}-price_3">price_3</option>
                    <option value="{{ $data->principal->principal }}-{{ $data->principal_id }}-price_4">price_4</option>
                    <option value="{{ $data->principal->principal }}-{{ $data->principal_id }}-none">none</option>
                    <option
                        value="{{ $data->principal->principal }}-{{ $data->principal_id }}-{{ $data->price_level }}"
                        selected>{{ $data->price_level }}</option>
                </select>
            @endforeach
        @endif

        @if (isset($principal))
            @foreach ($principal as $data)
                <label>{{ $data->principal }}</label>
                <select name="principal_price_selected[]" class="form-control" required>
                    <option value="" default>Select</option>
                    <option value="{{ $data->principal }}-{{ $data->id }}-price_1">price_1</option>
                    <option value="{{ $data->principal }}-{{ $data->id }}-price_2">price_2</option>
                    <option value="{{ $data->principal }}-{{ $data->id }}-price_3">price_3</option>
                    <option value="{{ $data->principal }}-{{ $data->id }}-price_4">price_4</option>
                    <option value="{{ $data->principal }}-{{ $data->id }}-none">none</option>
                </select>
            @endforeach
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
            <option value="{{ $customer->mode_of_transaction }}" selected>{{ $customer->mode_of_transaction }}
            </option>
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
            <option value="{{ $customer->location_id . ' - ' . $customer->location->location }}" selected>
                {{ $customer->location->location }}</option>
        </select>

        <label>Detailed Addres</label>
        <input type="text" class="form-control" name="detailed_address" value="{{ $customer->detailed_address }}"
            required>

        <label>Longitude</label>
        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $customer->longitude }}"
            required>

        <label>Latitude</label>
        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $customer->latitude }}"
            required>

        <input type="hidden" value="{{ $agent_user->agent_name }}" name="agent_name">
    </div>
    <br />
    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
    <button class="bt btn-info btn-block" type="submit">Proceed</button>
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

    $("#update_customer_generate_page_final_summary").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "update_customer_generate_page_final_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                $('#update_customer_generate_page_final_summary_page').html(data);
            },
        });
    }));
</script>
