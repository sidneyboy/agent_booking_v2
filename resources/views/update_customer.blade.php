@extends('layouts.master')

@section('title', 'CUSTOMER')

@section('navbar')


@section('sidebar')


@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">UPDATE CUSTOMER</h3>
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
                <form id="update_customer_generate" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Customer</label>
                            <select name="customer_id" style="width:100%" class="form-contorl select2" required>
                                <option value="" default>Select</option>
                                @foreach ($customer as $data)
                                    <option value="{{ $data->id }}">{{ $data->store_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <button class="btn btn-success btn-block" type="submit">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div id="update_customer_generate_page"></div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">GENERATE DATA</h3>
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
                <div id="update_customer_generate_page_final_summary_page"></div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{-- <label>Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" required>

                <label>Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" required> --}}
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

        //         $("#customer").change(function(e) {
        //             e.preventDefault();
        //             //$('.loading').show();
        //             customer = $('#customer').val();
        //             if (customer == "NEW CUSTOMER") {
        //                 $('#proceed').show();
        //             } else {
        //                 $.post({
        //                     type: "POST",
        //                     url: "/work_flow_check_customer_sales_order_status",
        //                     data: 'customer=' + customer,
        //                     success: function(data) {
        //                         if (data == 'maximum_allowed_sales_order_consumed') {
        //                             Swal.fire(
        //                                 'Maximum Allowed Sales Order Consumed',
        //                                 'Please Pay Past Sales Order First!',
        //                                 'error'
        //                             );

        //                             $('#proceed').hide();
        //                         } else {
        //                             $('#proceed').show();
        //                         }
        //                     },
        //                     error: function(error) {
        //                         console.log(error);
        //                     }
        //                 });
        //             }
        //         });

        $("#update_customer_generate").on('submit', (function(e) {
            e.preventDefault();
            //$('.loading').show();
            $.ajax({
                url: "update_customer_generate",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.loading').hide();
                    $('#update_customer_generate_page').html(data);
                },
            });
        }));
    </script>
    </body>

    </html>
@endsection
