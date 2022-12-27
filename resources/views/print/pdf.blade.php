<!DOCTYPE html>
<html>
    <head>
        <style>
            #customers {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 9pt;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td,
            #customers th {
                border: 1px solid #ddd;
                padding: 4px;
            }

            #customers tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #customers tr:hover {
                background-color: #ddd;
            }

            #customers th {
                padding-top: 6px;
                padding-bottom: 6px;
                text-align: left;
                background-color: #570cad;
                color: white;
            }
        </style>
    </head>
    <body>
        <h2 style="text-align: center">Laporan Stok Barang</h2>
        <h3 style="text-align: center">
            {{ date('d F Y', strtotime($from)) . ' - ' . date('d F Y', strtotime($to)) }}
        </h3>
        <table id="customers">
            <tr>
                <th>#</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th style="text-align: right">Stok Awal</th>
                <th style="text-align: right">Masuk</th>
                <th style="text-align: right">Keluar</th>
                <th style="text-align: right">Stok Akhir</th>
            </tr>
            @foreach($data as $row)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $row->kode }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->kategori->nama }}</td>
                <td style="text-align: right">
                    {{ number_format($row->stok_awal) }}
                </td>
                <td style="text-align: right">
                    {{ number_format($row->masuk) }}
                </td>
                <td style="text-align: right">
                    {{ number_format($row->keluar) }}
                </td>
                <td style="text-align: right">
                    {{ number_format($row->stok_akhir) }}
                </td>
            </tr>
            @endforeach
        </table>
        <p style="text-align: center">
            Updated: {{ date("d F Y H:i:s", strtotime(now())) }}
        </p>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            window.print();
        });
    </script>
</html>
