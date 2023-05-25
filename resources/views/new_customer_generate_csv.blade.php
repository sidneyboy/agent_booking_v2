@extends('layouts.master')

@section('title', 'CUSTOMER EXPORT')
<style>
    #new_customer th:first-child,
    #new_customer td:first-child {
        position: sticky;
        left: 0px;
        background-color: antiquewhite;
    }
</style>
@section('navbar')


@section('sidebar')


@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">CUSTOMER EXPORT</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form id="customer_export">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-sm" id="new_customer">
                            <thead>
                                <tr>
                                    <th>New Customer</th>
                                    <th>{{ $agent_user->agent_name . '-' . $date . '' . $time }}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>KOB</th>
                                    <th>Store Name</th>
                                    <th>Contact Person</th>
                                    <th>Contact Number</th>
                                    <th>Location ID</th>
                                    <th>Location </th>
                                    <th>Detailed Address</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Customer ID</th>
                                    <th>Mode of Transaction</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer_export as $exported)
                                    <tr>
                                        <td>{{ $exported->kob }}</td>
                                        <td>{{ $exported->store_name }}</td>
                                        <td>{{ $exported->contact_person }}</td>
                                        <td>{{ $exported->contact_number }}</td>
                                        <td>{{ $exported->location_id }}</td>
                                        <td>{{ $exported->location }}</td>
                                        <td>{{ $exported->detailed_address }}</td>
                                        <td>
                                            {{ $exported->longitude }}
                                            <input type="hidden" value="{{ $exported->id }}" name="customer_export_id[]">
                                        </td>
                                        <td>{{ $exported->latitude }}</td>
                                        <td>{{ $exported->customer_id }}</td>
                                        <td>{{ $exported->mode_of_transaction }}</td>
                                    </tr>
                                    @foreach ($exported->customer_export_details as $details)
                                        <tr>
                                            <td>Principal</td>
                                            <td>{{ $details->customer_id }}</td>
                                            <td>{{ $details->principal_id }}</td>
                                            <td>{{ $details->price_level }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>


                    </div>



                    <button class="btn btn-block btn-success" type="submit">EXPORT DATA</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button onclick="exportTableToCSV('{{ $agent_user->agent_name }} New Customer.csv')" style="display: none"
                    id="button_export">EXPORT
                    DATA</button>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection


@section('footer')
    @parent
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function downloadCSV(csv, filename) {
            var csvFile;
            var downloadLink;

            // CSV file
            csvFile = new Blob([csv], {
                type: "text/csv"
            });

            // Download link
            downloadLink = document.createElement("a");

            // File name
            downloadLink.download = filename;

            // Create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);

            // Hide download link
            downloadLink.style.display = "none";

            // Add the link to DOM
            document.body.appendChild(downloadLink);

            // Click download link
            downloadLink.click();
        }

        function exportTableToCSV(filename) {
            //$('.loading').show();
            var csv = [];
            var rows = document.querySelectorAll("#new_customer tr");

            for (var i = 0; i < rows.length; i++) {
                var row = [],
                    cols = rows[i].querySelectorAll("td, th");

                for (var j = 0; j < cols.length; j++)
                    row.push(cols[j].innerText);

                csv.push(row.join(","));
            }

            // Download CSV file
            downloadCSV(csv.join("\n"), filename);
            
        }

        $("#customer_export").on('submit', (function(e) {
            e.preventDefault();
            //$('.loading').show();
            $.ajax({
                url: "customer_export",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    //console.log(data);

                    $('#button_export').click();
                    location.reload();
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
                    //     window.location.href = "/principal_upload";
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
    </body>

    </html>
@endsection
