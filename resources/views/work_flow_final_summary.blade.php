<style>
    .wrapper {
        position: relative;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 200px;
        background-color: white;
    }

    table {
        width: 100%;
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
        padding: 0px;
        background-color: white,
            vertical-align: middle;
    }
</style>

<form id="work_flow_inventory_save">
    <div id="export_table_as_image">

        @if (isset($current_bo))
            @if (array_sum($current_bo) != 0)
                <table class="table table-bordered table-sm table-striped table_suggested_so">
                    <thead>
                        <tr>
                            <th colspan="4" style="color:blue">THIS WILL SERVE AS UNOFFICIAL BO PCM</th>
                        </tr>
                        <tr>
                            <th colspan="4">
                                {{ $bo_pcm }}
                                <input type="hidden" value="{{ $bo_pcm }}" name="bo_pcm">
                            </th>
                        </tr>
                        <tr>
                            <th>Desc</th>
                            <th>BO</th>
                            <th>U/P</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($current_bo_inventory_id as $bo_data)
                            <tr>
                                <td>
                                    <b style="color:blue">{{ $current_bo_inventory_sku_code[$bo_data] }}</b><br />

                                    {{ $current_bo_inventory_description[$bo_data] }} <br />
                                    <b style="color:green">{{ $sku_type }}</b>

                                </td>
                                <td style="text-align: right">{{ $current_bo[$bo_data] }}</td>
                                <td style="text-align: right">
                                    {{ number_format($current_bo_inventory_unit_price[$bo_data], 2, '.', ',') }}</td>
                                <td style="text-align: right">
                                    @php
                                        $bo_sub_total = $current_bo_inventory_unit_price[$bo_data] * $current_bo[$bo_data];
                                        echo number_format($bo_sub_total, 2, '.', ',');
                                        $bo_total[] = $bo_sub_total;
                                    @endphp
                                    <input type="hidden" value="{{ $bo_data }}" name="current_bo_inventory_id[]">

                                    <input type="hidden" value="{{ $current_bo_inventory_unit_price[$bo_data] }}"
                                        name="current_bo_unit_price[{{ $bo_data }}]">
                                    <input type="hidden" value="{{ $current_bo[$bo_data] }}"
                                        name="current_bo_quantity[{{ $bo_data }}]">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align: center">Total</th>
                            <th style="text-align: right">
                                {{ number_format(array_sum($bo_total), 2, '.', ',') }}
                                <input type="hidden" value="{{ array_sum($bo_total) }}" name="total_bo_amount">
                            </th>
                        </tr>
                    </tfoot>
                </table>
            @endif
        @endif




        @if (isset($current_rgs))
            @if (array_sum($current_rgs) != 0)
                <table class="table table-bordered table-sm table-striped table_suggested_so">
                    <thead>
                        <tr>
                            <th colspan="4" style="color:blue">THIS WILL SERVE AS UNOFFICIAL RGS PCM</th>
                        </tr>
                        <tr>
                            <th colspan="4">
                                {{ $rgs_pcm }}
                                <input type="hidden" value="{{ $rgs_pcm }}" name="rgs_pcm">
                            </th>
                        </tr>
                        <tr>
                            <th>Desc</th>
                            <th>BO</th>
                            <th>U/P</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($current_rgs_inventory_id as $rgs_data)
                            <tr>
                                <td>
                                    <b style="color:blue">{{ $current_rgs_inventory_sku_code[$rgs_data] }}</b><br />

                                    {{ $current_rgs_inventory_description[$rgs_data] }} <br />
                                    <b style="color:green">{{ $sku_type }}</b>

                                </td>
                                <td style="text-align: right">{{ $current_rgs[$rgs_data] }}</td>
                                <td style="text-align: right">
                                    {{ number_format($current_rgs_inventory_unit_price[$rgs_data], 2, '.', ',') }}</td>
                                <td style="text-align: right">
                                    @php
                                        $rgs_sub_total = $current_rgs_inventory_unit_price[$rgs_data] * $current_rgs[$rgs_data];
                                        echo number_format($rgs_sub_total, 2, '.', ',');
                                        $rgs_total[] = $rgs_sub_total;
                                    @endphp
                                    <input type="hidden" value="{{ $rgs_data }}"
                                        name="current_rgs_inventory_id[]">

                                    <input type="hidden" value="{{ $current_rgs_inventory_unit_price[$rgs_data] }}"
                                        name="current_rgs_unit_price[{{ $rgs_data }}]">
                                    <input type="hidden" value="{{ $current_rgs[$rgs_data] }}"
                                        name="current_rgs_quantity[{{ $rgs_data }}]">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align: center">Total</th>
                            <th style="text-align: right">
                                {{ number_format(array_sum($rgs_total), 2, '.', ',') }}
                                <input type="hidden" value="{{ array_sum($rgs_total) }}" name="total_rgs_amount">
                            </th>
                        </tr>
                    </tfoot>
                </table>
            @endif
        @endif

        @if (array_sum($sales_order_final_quantity) != 0)
            <hr style="border: 5px solid black;">
            <table style="text-align: center;">
                <tr>
                    <th>JULMAR COMMERCIAL INC.</th>
                </tr>
                <tr>
                    <th>OSMENA ST., CDO</th>
                </tr>
                <tr>
                    <th>TEL: 857-6197, 858-5771</th>
                </tr>
                <tr>
                    <th>TIN: 486-701-947-000</th>
                </tr>
                <tr>
                    <th>REP: {{ $agent_user->agent_name }}</th>
                </tr>
                <tr>
                    <th>{{ $date }}</th>
                </tr>
                <tr>
                    <th>{{ $sales_order_number }}</th>
                </tr>
                <tr>
                    <th>
                        {{ $customer_principal_price->customer->mode_of_transaction }}</th>
                </tr>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>Desc</th>
                        <th>Qty</th>
                        <th>U/P</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventory_data as $data)
                        @if ($sales_order_final_quantity[$data->id] != 0)
                            <tr>
                                <th>
                                    <b style="color:blue">{{ $data->sku_code }}</b><br />

                                    {{ $data->description }}<br />
                                    <b style="color:green">{{ $data->uom }}<b />
                                </th>
                                <th style="text-align: right">{{ $sales_order_final_quantity[$data->id] }}</th>
                                <th style="text-align: right">
                                    @if ($customer_principal_price->price_level == 'price_1')
                                        @php
                                            $unit_price = $data->price_1;
                                        @endphp
                                        {{ number_format($data->price_1, 2, '.', ',') }}
                                    @elseif($customer_principal_price->price_level == 'price_2')
                                        @php
                                            $unit_price = $data->price_2;
                                        @endphp
                                        {{ number_format($data->price_2, 2, '.', ',') }}
                                    @elseif($customer_principal_price->price_level == 'price_3')
                                        @php
                                            $unit_price = $data->price_3;
                                        @endphp
                                        {{ number_format($data->price_3, 2, '.', ',') }}
                                    @elseif($customer_principal_price->price_level == 'price_4')
                                        @php
                                            $unit_price = $data->price_4;
                                        @endphp
                                        {{ number_format($data->price_4, 2, '.', ',') }}
                                    @endif

                                    <input type="hidden" value="{{ $unit_price }}"
                                        name="unit_price[{{ $data->id }}]">
                                </th>
                                <th style="text-align: right">
                                    @php
                                        $sub_total = $unit_price * $sales_order_final_quantity[$data->id];
                                        echo number_format($sub_total, 2, '.', ',');
                                        $sum_total[] = $sub_total;
                                    @endphp

                                    <input type="hidden" value="{{ $data->id }}" name="inventory_id[]">
                                    <input type="hidden" value="{{ $sales_order_final_quantity[$data->id] }}"
                                        name="sales_order_quantity[{{ $data->id }}]">
                                </th>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <th style="text-align: right">{{ number_format(array_sum($sum_total), 2, '.', ',') }}</th>
                    </tr>
                    @php
                        $total = array_sum($sum_total);
                        $discount_holder = [];
                        $discount_value_holder = $total;
                    @endphp
                    @foreach ($customer_principal_discount as $data_discount)
                        <tr>
                            <th colspan="2"></th>
                            <th style="text-align: right">{{ $data_discount->discount_name }}</th>
                            <th style="text-align: right">
                                @php
                                    $discount_value_holder_dummy = $discount_value_holder;
                                    $less_percentage_by = $data_discount->discount_rate / 100;
                                    
                                    $discount_rate_answer = $discount_value_holder * $less_percentage_by;
                                    $discount_value_holder = $discount_value_holder - $discount_value_holder_dummy * $less_percentage_by;
                                    $discount_holder[] = $discount_value_holder;
                                    echo number_format($discount_value_holder, 2, '.', ',');
                                @endphp
                            </th>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3" style="text-align: right">Final Total</th>
                        <th style="text-align: right;text-decoration: overline">
                            @if (array_sum($discount_holder) != 0)
                                {{ number_format(end($discount_holder), 2, '.', ',') }}
                                @php
                                    $final_total = end($discount_holder);
                                @endphp
                            @else
                                {{ number_format(array_sum($sum_total), 2, '.', ',') }}
                                @php
                                    $final_total = array_sum($sum_total);
                                @endphp
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <div class="wrapper">
                                <canvas id="signature-pad" style="border:dotted;width:100%;height:150px;"
                                    class="signature-pad"></canvas>
                            </div>
                        </th>
                    </tr>
                </tfoot>
            </table>
            <input type="hidden" name="total_amount" value="{{ $final_total }}">
        @endif
    </div>
    <input type="hidden" name="agent_id" value="{{ $agent_user->agent_id }}">
    <input type="hidden" name="sales_order_number" value="{{ $sales_order_number }}">
    <input type="hidden" name="principal_id" value="{{ $principal_id }}">
    <input type="hidden" name="customer_id" value="{{ $customer_id }}">
    <input type="hidden" name="sku_type" value="{{ $sku_type }}">
    <input type="hidden" name="sales_register_id" value="{{ $sales_register_id }}">
    <input type="hidden" name="sales_order_final_quantity" value="{{ array_sum($sales_order_final_quantity) }}">
    <input type="hidden" name="mode_of_transaction"
        value="{{ $customer_principal_price->customer->mode_of_transaction }}">
    <button type="submit" class="btn btn-block btn-success">Submit Sales Order</button>
    <br />
</form>

<button class="btn btn-info btn-block" id="convert">Export as Image</button>


<div style="" id="result"></div>

<script src="{{ asset('js/signature_pad.umd.js') }}"></script>
<script src="{{ asset('js/app2.js') }}"></script>
<script>
    $("#convert").on('click', (function(e) {
        e.preventDefault();
        //alert('asdasd');
        //$('.loading').show();
        var resultDiv = document.getElementById("result");
        html2canvas(document.getElementById("export_table_as_image"), {
            onrendered: function(canvas) {
                var img = canvas.toDataURL("image/png");
                result.innerHTML =
                    '<a download="{{ $customer_principal_price->customer->store_name }} - SALES ORDER.jpeg" style="display:block;width:100%;border:none;background-color: #04AA6D;padding: 14px 28px;font-size: 16px;cursor: pointer;text-align: center;color:white;" href="' +
                    img + '" id="download_button">DOWNLOAD IMAGE</a>';
                $('.loading').hide();
                document.getElementById('download_button').click();
                $('#download_button').hide();
            }
        });
    }));







    $("#work_flow_inventory_save").on('submit', (function(e) {
        e.preventDefault();
        // $('.loading').show();
        $.ajax({
            url: "work_flow_inventory_save",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                });
                window.location.href = "/work_flow";
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

























    var canvas = document.getElementById('signature-pad');
    // Adjust canvas coordinate space taking into account pixel ratio,
    // to make it look crisp on mobile devices.
    // This also causes canvas to be cleared.
    function resizeCanvas() {
        // When zoomed out to less than 100%, for some very strange reason,
        // some browsers report devicePixelRatio as less than 1
        // and only part of the canvas is cleared then.
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }
    window.onresize = resizeCanvas;
    resizeCanvas();
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    });
    document.getElementById('save-png').addEventListener('click', function() {
        if (signaturePad.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad.toDataURL('image/png');
        console.log(data);
        window.open(data);
    });
    document.getElementById('save-jpeg').addEventListener('click', function() {
        if (signaturePad.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad.toDataURL('image/jpeg');
        console.log(data);
        window.open(data);
    });
    document.getElementById('save-svg').addEventListener('click', function() {
        if (signaturePad.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad.toDataURL('image/svg+xml');
        console.log(data);
        console.log(atob(data.split(',')[1]));
        window.open(data);
    });
    document.getElementById('clear').addEventListener('click', function() {
        signaturePad.clear();
    });
    document.getElementById('draw').addEventListener('click', function() {
        var ctx = canvas.getContext('2d');
        console.log(ctx.globalCompositeOperation);
        ctx.globalCompositeOperation = 'source-over'; // default value
    });
    document.getElementById('erase').addEventListener('click', function() {
        var ctx = canvas.getContext('2d');
        ctx.globalCompositeOperation = 'destination-out';
    });
</script>
