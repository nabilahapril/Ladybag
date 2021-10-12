<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <h5>Laporan Order Periode ({{ $date[0] }} - {{ $date[1] }})</h5>
    <hr>
    <table width="100%" class="table-hover table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Subtotal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            <?php $no = 0;?>
                                        @forelse ($payments as $row)
                                        <?php $no++ ;?>
                                                    <tr>
                                                        <td>{{ $no }}</td>
                                            
                
                    <td>
                        <label><strong>Telp:</strong> {{ $row->phone }}</label><br>
                        <label><strong>Alamat:</strong> {{ $row->address }} {{ $row->district->name }}</label>
                    </td>
                    <td>Rp {{ number_format($row->subtotal) }}</td>
                    <td>{{ $row->created_at}}</td>
                </tr>
                @php $total += $row->total @endphp
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Total</td>
                <td>Rp {{ number_format($total) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>