<form id="update_customer_save">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Store Name</th>
                <th>{{ $store_name }}
                    <input type="hidden" name="store_name" value="{{ $store_name }}">
                </th>
            </tr>
            <tr>
                <th>Contact Person</th>
                <th>{{ $contact_person }}
                    <input type="hidden" name="contact_person" value="{{ $contact_person }}">
                </th>
            </tr>
            <tr>
                <th>Contact Number</th>
                <th>{{ $contact_number }}
                    <input type="hidden" name="contact_number" value="{{ $contact_number }}">
                </th>
            </tr>
            <tr>
                <th>Detailed Address</th>
                <th>{{ $detailed_address }}
                    <input type="hidden" name="detailed_address" value="{{ $detailed_address }}">
                </th>
            </tr>
            <tr>
                <th>KOB</th>
                <th>{{ $kob }}
                    <input type="hidden" name="kob" value="{{ $kob }}">
                </th>
            </tr>
            <tr>
                <th>Latitude</th>
                <th>{{ $latitude }}
                    <input type="hidden" name="latitude" value="{{ $latitude }}">
                </th>
            </tr>
            <tr>
                <th>Longitude</th>
                <th>{{ $longitude }}
                    <input type="hidden" name="longitude" value="{{ $longitude }}">
                </th>
            </tr>
            <tr>
                <th>Location</th>
                <th>{{ $location }}
                    <input type="hidden" name="location" value="{{ $location }}">
                </th>
            </tr>
            <tr>
                <th>Location ID</th>
                <th>{{ $location_id }}
                    <input type="hidden" name="location_id" value="{{ $location_id }}">
                </th>
            </tr>
            <tr>
                <th>MOT</th>
                <th>{{ $mode_of_transaction }}
                    <input type="hidden" name="mode_of_transaction" value="{{ $mode_of_transaction }}">
                </th>
            </tr>
            @if ($principal_level != 'none')
                @foreach ($principal_level as $data)
                    <tr>
                        <th colspan="2" style="text-transform:uppercase;text-align:center">
                            {{ $data }}
                            <input type="hidden" name="customer_current_price_Level[]" value="{{ $data }}">
                        </th>
                    </tr>
                @endforeach
            @endif
            @if (isset($principal_price_selected))
                @foreach ($principal_price_selected as $data)
                    <tr>
                        <th colspan="2" style="text-transform:uppercase;text-align:center">
                            {{ $data }}
                            <input type="hidden" name="principal_price_selected[]" value="{{ $data }}">
                        </th>
                    </tr>
                @endforeach
            @endif
        </thead>
    </table>
    <input type="hidden" name="customer_id" value="{{ $customer_id }}">
    <button class="btn btn-block btn-success" type="submit">Update and Save</button>

</form>

<script>
    $("#update_customer_save").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "update_customer_save",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                console.log(data);
                if (data == 'saved') {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'CUSTOMER UPDATED SUCCESSFULLY, REDIRECTING...',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    // window.location.href = "/work_flow";
                    location.reload();
                }
            },
        });
    }));
</script>
