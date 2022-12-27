@extends('layouts.main') @section('content')
<style>
    img {
        margin: auto;
    }
    #html5-qrcode-button-camera-permission,
    #html5-qrcode-button-camera-start,
    #html5-qrcode-button-camera-stop {
        background-color: #570cad;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }
    #html5-qrcode-anchor-scan-type-change {
        visibility: hidden;
    }
</style>
<div class="w-full h-full" id="reader"></div>

<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        // alert(`Scan result: ${decodedText}`, decodedResult);
        window.location.replace(decodedText);
    }

    var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: 250,
    });

    function onScanError(errorMessage) {
        // handle on error condition, with error message
    }

    var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: 250,
    });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
@endsection
