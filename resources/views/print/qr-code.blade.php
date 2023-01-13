<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title.$barang->kode }}</title>
    </head>
    <style>
        body * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 7pt;
        }
        .container {
            /* background-color: red; */
            width: max-content;
            margin-left: auto;
            margin-right: auto;
        }
        .qr {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
    </style>
    <body>
        <div class="container">
            <div class="qr">
                <img
                    src="data:image/png;base64,{{ DNS2D::getBarcodePNG(route('barang.detail.public', $barang->id), 'QRCODE',15,15) }}"
                    alt="qr-code"
                    width="55"
                    height="55"
                />
                Kode: {{ $barang->kode }}
                <br />
                Nama: {{ $barang->nama }}
                <br />
                Kategori: {{ $barang->kategori->nama }}
                <br />
                Dicetak: <br />{{ date("d-m-Y H:i:s") }}
            </div>
        </div>
    </body>
</html>
