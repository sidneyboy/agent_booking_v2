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
                <h3 class="card-title" style="font-weight: bold;">PCM EXPORT</h3>
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
                <form id="pcm_export_generate" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>PCM</label>
                            <select name="pcm_id" style="width:100%" class="form-contorl select2" required>
                                <option value="" default>Select</option>
                                @foreach ($bad_order as $bo)
                                    <option value="{{ 'bo-'.$bo->id }}">{{ $bo->pcm_number }}</option>
                                @endforeach
                                @foreach ($rgs as $rgs)
                                    <option value="{{ 'rgs-'.$rgs->id }}">{{ $rgs->pcm_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <button class="btn btn-info btn-block" type="submit">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div id="pcm_export_generate_page"></div>
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

        $("#pcm_export_generate").on('submit', (function(e) {
            e.preventDefault();
            //$('.loading').show();
            $.ajax({
                url: "pcm_export_generate",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.loading').hide();
                    $('#pcm_export_generate_page').html(data);
                },
            });
        }));
    </script>
    </body>

    </html>
@endsection
