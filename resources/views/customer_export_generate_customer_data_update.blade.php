<form id="customer_export_generate_customer_data_update_generate_data">
    <select name="customer_id" class="form-control select2" required>
        <option value="" default>SELECT CUSTOMER TO BE UPDATE</option>
        @foreach ($customer as $data)
            <option value="{{ $data->id }}">{{ $data->store_name }}</option>
        @endforeach
    </select>
    <br />
    <button class="btn btn-info btn-block">Generate Customer Data</button>

</form>

<script>
    $('.select2').select2()

    $("#customer_export_generate_customer_data_update_generate_data").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "customer_export_generate_customer_data_update_generate_data",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                $('#customer_export_generate_final_summary_page').html(data)
                // if (data == 'saved') {
                //     Swal.fire({
                //         position: 'top-end',
                //         icon: 'success',
                //         title: 'Location Data Uploaded',
                //         showConfirmButton: false,
                //         timer: 1500
                //     })

                //     $('.loading').hide();
                //     // location.reload();
                //     window.location.href = "/new_customer_generate_csv";
                // } else {
                //     Swal.fire(
                //         'Something went wrong!',
                //         data,
                //         'error'
                //     )
                //     $('.loading').hide();
                // }
            },
        });
    }));
</script>
