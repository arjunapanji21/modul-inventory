@extends('layouts.secondary') @section('content')
<div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col">
        <div class="text-center">
            <h1 class="text-5xl font-bold my-10">Forgot Password</h1>
        </div>
        <div class="card w-full shadow-2xl bg-base-100">
            <div class="card-body">
                <form action="{{ route('user.forgot') }}" method="post">
                    @csrf @method('put')
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input
                            name="email"
                            type="email"
                            placeholder="email"
                            class="input input-bordered"
                        />
                    </div>
                    <div class="form-control my-4">
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                    </div>
                </form>
                <div class="flex">
                    <label class="label mx-auto">
                        <a
                            href="{{ route('user.login') }}"
                            class="label-text-alt link link-hover"
                            >Back to login</a
                        >
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
