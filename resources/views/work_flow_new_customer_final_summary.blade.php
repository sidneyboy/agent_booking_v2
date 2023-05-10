<form id="work_flow_new_customer_saved">
    <div class="table table-responsive">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th colspan="4">{{ $sales_order_number }}</th>
                </tr>
                <tr>
                    <th>Desc</th>
                    <th>Qty</th>
                    <th>U/P</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventory_data as $data)
                    <tr>
                        <td>{{ $data->sku_code }} - {{ $data->description }}</td>
                        <td>{{ $new_sales_order[$data->id] }}</td>
                        <td style="text-align: right">
                            @if ($price_level == 'price_1')
                                @php
                                    $unit_price = $data->price_1;
                                @endphp
                                {{ number_format($data->price_1, 2, '.', ',') }}
                            @elseif($price_level == 'price_2')
                                @php
                                    $unit_price = $data->price_2;
                                @endphp
                                {{ number_format($data->price_2, 2, '.', ',') }}
                            @elseif($price_level == 'price_3')
                                @php
                                    $unit_price = $data->price_3;
                                @endphp
                                {{ number_format($data->price_3, 2, '.', ',') }}
                            @elseif($price_level == 'price_4')
                                @php
                                    $unit_price = $data->price_4;
                                @endphp
                                {{ number_format($data->price_4, 2, '.', ',') }}
                            @endif
                        </td>
                        <td style="text-align: right">
                            {{ number_format($unit_price * $new_sales_order[$data->id], 2, '.', ',') }}
                            @php
                                $total = $unit_price * $new_sales_order[$data->id];
                                $total_sum[] = $total;
                            @endphp
                            <input type="hidden" name="inventory_id[]" value="{{ $data->id }}">
                            <input type="hidden" name="unit_price[{{ $data->id }}]" value="{{ $unit_price }}">
                            <input type="hidden" name="quantity[{{ $data->id }}]" value="{{ $new_sales_order[$data->id] }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right">{{ number_format(array_sum($total_sum), 2, '.', ',') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <input type="hidden" name="total_amount" value="{{ array_sum($total_sum) }}">
    <input type="hidden" name="store_name" value="{{ $store_name }}">
    <input type="hidden" name="sales_order_number" value="{{ $sales_order_number }}">
    <input type="hidden" name="agent_id" value="{{ $agent_user->agent_id }}">
    <input type="hidden" name="kob" value="{{ $kob }}">
    <input type="hidden" name="agent_name" value="{{ $agent_name }}">
    <input type="hidden" name="contact_number" value="{{ $contact_number }}">
    <input type="hidden" name="contact_person" value="{{ $contact_person }}">
    <input type="hidden" name="detailed_address" value="{{ $detailed_address }}">
    <input type="hidden" name="latitude" value="{{ $latitude }}">
    <input type="hidden" name="longitude" value="{{ $longitude }}">
    <input type="hidden" name="location" value="{{ $location }}">
    <input type="hidden" name="principal_id" value="{{ $principal_id }}">
    <input type="hidden" name="sku_type" value="{{ $sku_type }}">
    <button class="btn btn-success btn-block">Submit</button>
</form>


<script>
    $("#work_flow_new_customer_saved").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "work_flow_new_customer_saved",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                if (data == "saved") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.href = "/collection";
                } else {
                    alert('asdasd');
                }

            },
        });
    }));
</script>
