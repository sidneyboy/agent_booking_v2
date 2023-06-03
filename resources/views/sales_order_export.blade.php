@extends('layouts.master')
@section('title', 'SALES ORDER EXPORT')
<style>
    .table_sales_order_export th:first-child,
    .table_sales_order_export td:first-child {
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
        @if (count($sales_order))
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">SALES ORDER EXPORT</h3>
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
                    <form id="sales_order_export_process">
                        <div class="table table-responsive" id="export_table">
                            @foreach ($sales_order as $data)
                                <table class="table table-bordered table-striped table-sm table_sales_order_export">
                                    <thead>
                                        <tr>
                                            <th>Customer ID</th>
                                            <th>Store Name</th>
                                            <th>Principal ID</th>
                                            <th>Principal</th>
                                            <th>Agent ID</th>
                                            <th>Agent</th>
                                            <th>Mode of Transaction</th>
                                            <th>Sku Type</th>
                                            <th>Total Amount</th>
                                            <th>SO</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $data->customer_id }}</td>
                                            <td>{{ $data->customer->store_name }}</td>
                                            <td>{{ $data->principal_id }}</td>
                                            <td>{{ $data->principal->principal }}</td>
                                            <td>{{ $data->agent_id }}</td>
                                            <td>{{ $data->agent->agent_name }}</td>
                                            <td style="text-transform:uppercase">{{ $data->mode_of_transaction }}</td>
                                            <td style="text-transform:uppercase">{{ $data->sku_type }}</td>
                                            <td>{{ $data->total_amount }}</td>
                                            <td>
                                                {{ $data->sales_order_number }}
                                                <input type="hidden" name="sales_order_id[]" value="{{ $data->id }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Code</th>
                                            <th>Sku ID</th>
                                            <th>Desc</th>
                                            <th>Unit of Measurement</th>
                                            <th>Qty</th>
                                            <th>U/P</th>
                                            <th>Sub Total</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->sales_order_details as $details)
                                            <tr>
                                                <td>{{ $details->inventory->sku_code }}</td>
                                                <td>{{ $details->inventory_id }}</td>
                                                <td>{{ $details->inventory->description }}</td>
                                                <td>{{ $details->inventory->uom }}</td>
                                                <td>{{ $details->quantity }}</td>
                                                <td>{{ $details->unit_price }}</td>
                                                <td>{{ $details->unit_price * $details->quantity }}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-success btn-block">EXPORT SALES ORDER</button>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button id="trigger"
                        onclick="exportTableToCSV('{{ preg_replace('/[^a-zA-Z0-9_ -]/s',' ',$sales_order[0]->sales_order_number)  }}.csv')"
                        class="btn btn-success btn-block btn-sm" style="display: none">Export Sales Order</button>
                </div>
                <!-- /.card-footer-->
            </div>


        @endif



        @if (count($sales_order_for_new_customer))
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">SALES ORDER EXPORT</h3>
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
                    <form id="sales_order_new_customer_export_process">
                        <div class="table table-responsive" id="export_table">
                            @foreach ($sales_order_for_new_customer as $data)
                                <table class="table table-bordered table-sm table_sales_order_export">
                                    <thead>
                                        <tr>
                                            <th>Customer ID</th>
                                            <th>Store Name</th>
                                            <th>Principal ID</th>
                                            <th>Principal</th>
                                            <th>Agent ID</th>
                                            <th>Agent</th>
                                            <th>Mode of Transaction</th>
                                            <th>Sku Type</th>
                                            <th>Total Amount</th>
                                            <th>SO</th>
                                        </tr>

                                        <tr>
                                            <td>NEW CUSTOMER</td>
                                            <td>{{ $data->sales_order_new_customer->store_name }}</td>
                                            <td>{{ $data->principal_id }}</td>
                                            <td>{{ $data->principal->principal }}</td>
                                            <td>{{ $data->agent_id }}</td>
                                            <td>{{ $data->agent->agent_name }}</td>
                                            <td style="text-transform:uppercase">{{ $data->mode_of_transaction }}</td>
                                            <td style="text-transform:uppercase">{{ $data->sku_type }}</td>
                                            <td>{{ $data->total_amount }}</td>
                                            <td>
                                                {{ $data->sales_order_number }}
                                                <input type="hidden" name="sales_order_id[]" value="{{ $data->id }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>kob</th>
                                            <th>Contact Person</th>
                                            <th>Conctact Number</th>
                                            <th>Location</th>
                                            <th>Location ID</th>
                                            <th>Detailed Address</th>
                                            <th>Longitude</th>
                                            <th>Latitude</th>
                                            <th>Status</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $data->sales_order_new_customer->kob }}</td>
                                            <td>{{ $data->sales_order_new_customer->contact_person }}</td>
                                            <td>{{ $data->sales_order_new_customer->contact_number }}</td>
                                            <td>{{ $data->sales_order_new_customer->location }}</td>
                                            <td>{{ $data->sales_order_new_customer->location_id }}</td>
                                            <td>{{ $data->sales_order_new_customer->detailed_address }}</td>
                                            <td>{{ $data->sales_order_new_customer->longitude }}</td>
                                            <td>{{ $data->sales_order_new_customer->latitude }}</td>
                                            <td>{{ $data->sales_order_new_customer->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Code</th>
                                            <th>Sku ID</th>
                                            <th>Desc</th>
                                            <th>Unit of Measurement</th>
                                            <th>Qty</th>
                                            <th>U/P</th>
                                            <th>Sub Total</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->sales_order_details as $details)
                                            <tr>
                                                <td>{{ $details->inventory->sku_code }}</td>
                                                <td>{{ $details->inventory_id }}</td>
                                                <td>{{ $details->inventory->description }}</td>
                                                <td>{{ $details->inventory->uom }}</td>
                                                <td>{{ $details->quantity }}</td>
                                                <td>{{ $details->unit_price }}</td>
                                                <td>{{ $details->unit_price * $details->quantity }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-success btn-block">EXPORT SALES ORDER</button>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button id="trigger_2" onclick="exportTableToCSV('{{ $data->sales_order_number }}.csv')"
                        class="btn btn-success btn-block btn-sm" style="display: none">Export Sales Order</button>
                </div>
                <!-- /.card-footer-->
            </div>
        @endif


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
            var csv = [];
            var rows = document.querySelectorAll("#export_table tr");

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

        $("#sales_order_new_customer_export_process").on('submit', (function(e) {
            e.preventDefault();
            //$('.loading').show();
            $.ajax({
                url: "sales_order_new_customer_export_process",
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
                            title: 'Sales Order Exported',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('.loading').hide();
                        // location.reload();
                        $('#trigger_2').click();
                        // window.location.href = "/work_flow";
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

        $("#sales_order_export_process").on('submit', (function(e) {
            e.preventDefault();
            //$('.loading').show();
            $.ajax({
                url: "sales_order_export_process",
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
                            title: 'Sales Order Exported',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('.loading').hide();
                        $('#trigger').click();
                        window.location.href = "/work_flow";
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
    </body>

    </html>
@endsection
