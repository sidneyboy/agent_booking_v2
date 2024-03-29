<form action="{{ route('pcm_export_change_status') }}" method="post">
    @csrf
    @if ($transaction == 'bo')
        <input type="hidden" value="{{ $details[0]->pcm->id }}" name="id">
        <div class="table table-responsive">
            <table class="table table-bordered table-hover table-sm table-striped" style="width:100%;" id="export_table">
                <thead>
                    <tr>
                        <th>{{ $details[0]->pcm->customer->store_name }}</th>
                        <th>{{ $details[0]->pcm->customer_id }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{ $details[0]->pcm->pcm_number }}</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>{{ $agent_user->agent_name }}</th>
                        <th>{{ $details[0]->pcm->principal->principal }}</th>
                        <th>{{ $details[0]->pcm->principal_id }}</th>
                        <th>{{ $details[0]->pcm->agent_id }}</th>
                        <th>{{ $details[0]->inventory->sku_type }}</th>
                        <th>{{ $details[0]->pcm->created_at }}</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Sku Type</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">U/P</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $data)
                        <tr>
                            <td>{{ $data->inventory->id }}</td>
                            <td>{{ $data->inventory->sku_code }}</td>
                            <td>{{ $data->inventory->description }}</td>
                            <td>{{ $data->inventory->sku_type }}</td>
                            <td style="text-align: right">{{ $data->quantity }}</td>
                            <td style="text-align: right">{{ $data->unit_price }}</td>
                            <td style="text-align: right">
                                @php
                                    $total = $data->quantity * $data->unit_price;
                                    $sum_total[] = $total;
                                    echo $total;
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: right">{{ array_sum($sum_total) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <input type="hidden" value="{{ $details[0]->pcm->id }}" name="id">
        <div class="table table-responsive">
            <table class="table table-bordered table-hover table-sm table-striped" style="width:100%;"
                id="export_table">
                <thead>
                    <tr>
                        <th>{{ $details[0]->pcm->customer->store_name }}</th>
                        <th>{{ $details[0]->pcm->customer_id }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{ $details[0]->pcm->pcm_number }}</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>{{ $agent_user->agent_name }}</th>
                        <th>{{ $details[0]->pcm->principal->principal }}</th>
                        <th>{{ $details[0]->pcm->principal_id }}</th>
                        <th>{{ $details[0]->pcm->agent_id }}</th>
                        <th>{{ $details[0]->inventory->sku_type }}</th>
                        <th>{{ $details[0]->pcm->created_at }}</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Sku Type</th>
                        <th>Quantity</th>
                        <th>U/P</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $data)
                        <tr>
                            <td>{{ $data->inventory->id }}</td>
                            <td>{{ $data->inventory->sku_code }}</td>
                            <td>{{ $data->inventory->description }}</td>
                            <td>{{ $data->inventory->sku_type }}</td>
                            <td style="text-align: right">{{ $data->quantity }}</td>
                            <td style="text-align: right">{{ $data->unit_price }}</td>
                            <td style="text-align: right">
                                @php
                                    $total = $data->quantity * $data->unit_price;
                                    $sum_total[] = $total;
                                    echo $total;
                                @endphp

                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: right">{{ array_sum($sum_total) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif
    <input type="hidden" name="transaction" value="{{ $transaction }}">
    <br />
    <button onclick="exportTableToCSV('{{ $filename }}.csv')" class="btn btn-success btn-block"
        type="submit">Export</button>
</form>

<script>
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
</script>
