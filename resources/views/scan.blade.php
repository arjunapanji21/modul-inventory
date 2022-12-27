@extends('layouts.main') @section('content')
<div class="w-full h-full" id="reader"></div>

<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`, decodedResult);
    }

    var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: 250,
    });
    html5QrcodeScanner.render(onScanSuccess);

    var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: 250,
    });

    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`, decodedResult);
        // ...
        html5QrcodeScanner.clear();
        // ^ this will stop the scanner (video feed) and clear the scan area.
    }

    html5QrcodeScanner.render(onScanSuccess);

    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`, decodedResult);
    }

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
