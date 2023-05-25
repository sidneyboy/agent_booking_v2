<form id="customer_export_new_customer_saved">
    <table class="table table-bordered table-hover table-sm table-striped">
        <thead>
            <tr>
                <th colspan="2">New Customer Data</th>
            </tr>
            <tr>
                <th>KOB:</th>
                <th>{{ $kob }}</th>
            </tr>
            <tr>
                <th>Store Name:</th>
                <th>{{ $store_name }}</th>
            </tr>
            <tr>
                <th>Contact Person:</th>
                <th>{{ $contact_person }}</th>
            </tr>
            <tr>
                <th>Contact Number:</th>
                <th>{{ $contact_number }}</th>
            </tr>
            <tr>
                <th>Location:</th>
                <th>{{ $location }}</th>
            </tr>
            <tr>
                <th>Detailed Address:</th>
                <th>{{ $detailed_address }}</th>
            </tr>
            <tr>
                <th>Longitude:</th>
                <th>{{ $longitude }}</th>
            </tr>
            <tr>
                <th>Latitude:</th>
                <th>{{ $latitude }}</th>
            </tr>
        </thead>
    </table>

    <input type="hidden" name="store_name" value="{{ $store_name }}">
    <input type="hidden" name="kob" value="{{ $kob }}">
    <input type="hidden" name="contact_person" value="{{ $contact_person }}">
    <input type="hidden" name="contact_number" value="{{ $contact_number }}">
    <input type="hidden" name="location" value="{{ $location }}">
    <input type="hidden" name="location_id" value="{{ $location_id }}">
    <input type="hidden" name="detailed_address" value="{{ $detailed_address }}">
    <input type="hidden" name="longitude" value="{{ $longitude }}">
    <input type="hidden" name="latitude" value="{{ $latitude }}">
    <button class="btn btn-success btn-block" type="submit">Submit</button>
</form>

<script>
    $("#customer_export_new_customer_saved").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "customer_export_new_customer_saved",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data == "saved") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Location Data Uploaded',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $('.loading').hide();
                    // location.reload();
                    window.location.href = "/new_customer_generate_csv";
                } else {
                    Swal.fire(
                        'Something went wrong!',
                        data,
                        'error'
                    )
                    $('.loading').hide();
                }
            },
        });
    }));
</script>
