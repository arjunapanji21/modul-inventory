@extends('layouts.main') @section('content')
<div class="w-full h-full" id="reader"></div>

<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        alert(`Scan result: ${decodedText}`, decodedResult);
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
