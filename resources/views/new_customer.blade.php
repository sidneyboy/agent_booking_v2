@extends('layouts.master')

@section('title', 'NEW CUSTOMER')

@section('navbar')


@section('sidebar')


@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">NEW CUSTOMER</h3>
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
                <form id="customer_export_generate_customer">
                    <div class="form-group">
                        <select name="select_mode" id="" class="form-control select2" style="width:100%" required>
                            <option value="" default>Select</option>
                            <option value="New Customer">New Customer</option>
                            <option value="Update Customer">Update Customer</option>
                        </select>
                    </div>

                    <button class="btn btn-info btn-block">Proceed</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div id="customer_export_generate_customer_page"></div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">SUMMARY</h3>
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
                <div id="customer_export_generate_final_summary_page"></div>
            </div>
            <!-- /.card-footer-->
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">FINAL</h3>
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
                <div id="customer_export_generate_final_summary_for_customer_update"></div>
            </div>
            <!-- /.card-footer-->
        </div>
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

        $("#customer_export_generate_customer").on('submit', (function(e) {
            e.preventDefault();
            //$('.loading').show();
            $.ajax({
                url: "customer_export_generate_customer",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    $('#customer_export_generate_customer_page').html(data)
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
    </body>

    </html>
@endsection
