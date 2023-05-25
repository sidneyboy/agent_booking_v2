<form id="customer_export_generate_final_summary">
    <div class="form-group">
        <label>KOB</label>
        <select name="kob" class="form-control select2" required>
            <option value="" default>Select</option>
            <option value="{{ $customer_data->kob }}" selected>{{ $customer_data->kob }}</option>
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
        <input type="text" class="form-control" name="store_name" value="{{ $customer_data->store_name }}" required>

        <label>Contact Person</label>
        <input type="text" class="form-control" name="contact_person" value="{{ $customer_data->contact_person }}" required>

        <label>Contact Number</label>
        <input type="number" min="0" class="form-control" name="contact_number" value="{{ $customer_data->contact_number }}" required>

        <label>Location</label>
        <select name="location" id="" class="form-control select2" style="width:100%;">
            <option value="" default>Select</option>
            <option value="{{ $customer_data->location_id . '-' . $customer_data->location->location }}" selected>{{ $customer_data->location->location }}</option>
            @foreach ($location as $data)
                <option value="{{ $data->id . '-' . $data->location }}">{{ $data->location }}</option>
            @endforeach
        </select>

        <label>Detailed Address</label>
        <input type="text" class="form-control" name="detailed_address" value="{{ $customer_data->detailed_address }}" required>

        <label>Longitude</label>
        <input type="text" class="form-control" name="longitude" value="{{ $customer_data->longitude }}" required>

        <label>Latitude</label>
        <input type="text" class="form-control" name="latitude" value="{{ $customer_data->latitude }}" required>


        {{-- <input type="hidden" value="{{ $agent_user->agent_name }}" name="agent_name"> --}}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info btn-block">PROCEED</button>
    </div>
</form>

<script>
    $("#customer_export_generate_final_summary").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "customer_export_generate_final_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                $('#customer_export_generate_final_summary_page').html(data)
            },
        });
    }));
</script>
