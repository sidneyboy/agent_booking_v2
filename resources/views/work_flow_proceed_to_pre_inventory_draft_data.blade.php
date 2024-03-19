<style>
    .table_suggested_so th:first-child,
    .table_suggested_so td:first-child {
        position: sticky;
        left: 0px;
        background-color: antiquewhite;
    }
</style>


<form id="work_flow_suggested_sales_order">
    @csrf
    <div class="table table-responsive">
        <table class="table table-sm table-bordered table-striped table_suggested_so" id="example2"
            style="font-size:13px;">
            <thead>
                <tr>
                    <th>Desc</th>
                    <th>RGS</th>
                    <th>BO</th>
                    <th>Remaining</th>
                    <th>U/P</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales_order_inventory as $data)
                    <tr>
                        <td>
                            <b style="color:blue;">{{ $data->sku_code }}</b><br />
                            {{ $data->description }} <br />
                            <b style="color:green">{{ $data->sku_type }}</b>
                            <input type="hidden" name="current_inventory_id[]" value="{{ $data->id }}">
                            {{-- <input type="hidden" name="current_inventory_description[{{ $data->id }}]"
                                value="{{ $data->description }}"> --}}

                        </td>
                        <td>
                            <input style="width:100px;text-align:center;" name="current_rgs[{{ $data->id }}]"
                                type="number" min="0" value="0" required class="form-control">

                        </td>
                        <td>
                            <input style="width:100px;text-align:center;" name="current_bo[{{ $data->id }}]"
                                type="number" min="0" value="0" required class="form-control">
                        </td>
                        <td>
                            <input style="width:100px;text-align:center;"
                                name="current_remaining_inventory[{{ $data->id }}]" type="number" min="0"
                                value="0" required class="form-control">
                            {{-- <input type="hidden" name="prev_delivered_inventory[{{ $data->inventory_id }}]"
                                value="0"> --}}
                        </td>
                        <td>
                            @if ($customer_principal_price == 'price_1')
                                {{ $data->price_1 }}
                                @php
                                    $unit_price = $data->price_1;
                                @endphp
                            @elseif ($customer_principal_price == 'price_2')
                                {{ $data->price_2 }}
                                @php
                                    $unit_price = $data->price_2;
                                @endphp
                            @elseif ($customer_principal_price == 'price_3')
                                {{ $data->price_3 }}
                                @php
                                    $unit_price = $data->price_3;
                                @endphp
                            @elseif ($customer_principal_price == 'price_4')
                                {{ $data->price_4 }}
                                @php
                                    $unit_price = $data->price_4;
                                @endphp
                            @endif

                            <input type="hidden" name="current_inventory_unit_price[{{ $data->id }}]"
                                value="{{ $unit_price }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <input type="hidden" value="{{ $customer_id }}" name="customer_id">
    <input type="hidden" value="{{ $principal_id }}" name="principal_id">
    <input type="hidden" value="{{ $sku_type }}" name="sku_type">
    {{-- <input type="hidden" value="{{ $sales_register->date_delivered }}" name="date_delivered">
    <input type="hidden" value="{{ $sales_register->id }}" name="sales_register_id"> --}}
    <button class="btn btn-block btn-info" type="submit">PROCEED</button>
</form>

<script>
    $("#work_flow_suggested_sales_order").on('submit', (function(e) {
        e.preventDefault();
        // $('.loading').show();
        Swal.fire({
            title: 'Save as draft ?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                $('.loading').show();
                $.ajax({
                    url: "work_flow_inventory_save_as_draft",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('.loading').hide();
                        if (data == 'saved') {
                            $('.loading').hide();
                            Swal.fire(
                                'Work saved to Draft',
                                '',
                                'success'
                            )

                            window.location.href = "/work_flow";
                        }
                    },
                });
            } else if (result.isDenied) {
                $('.loading').hide();
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }));

    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
    });
</script>
