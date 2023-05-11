@extends('layouts.master')

@section('title', 'UPLOAD PRICE')

@section('navbar')


@section('sidebar')


@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">UPLOAD NEW CUSTOMER PRICE</h3>
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
                <form id="customer_principal_price_upload_process">
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" name="agent_csv_file" required class="form-control">
                    </div>
                    <div class="form-group">

                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

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


        $("#customer_principal_price_upload_process").on('submit', (function(e) {
            e.preventDefault();
            //$('.loading').show();
            $.ajax({
                url: "customer_principal_price_upload_process",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data == 'saved') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'UPLOAD SUCCESS. REDIRECTING TO CUSTOMER PRINCIPAL CODE!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.location.href = "/customer_principal_price_upload";
                    } else if (data == 'incorrect_file') {
                        Swal.fire(
                            'INCORRECT FILE',
                            'FILE NAME SHOULD BE (CUSTOMER APPLIED TO AGENT)',
                            'error'
                        )
                        $('.loading').hide();
                    } else {
                        Swal.fire(
                            'SOMETHING WENT WRONG',
                            'CONTACT JULMAR ADMIN',
                            'error'
                        )
                        $('.loading').hide();
                    }
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
    </body>

    </html>
@endsection
