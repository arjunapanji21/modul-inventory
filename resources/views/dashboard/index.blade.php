@extends('layouts.main') @section('content')
<div class="p-10">
    <div class="alert bg-base-100 shadow-lg">
        <div>
            <span>Welcome, {{ auth()->user()->name }}!</span>
        </div>
    </div>
</div>
@endsection
