@extends('layouts.secondary') @section('content')
<div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-10">Registration</h1>
        </div>
        <div class="card w-full shadow-2xl bg-base-100">
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input
                            name="name"
                            type="text"
                            placeholder="name"
                            class="input input-bordered"
                        />
                    </div>
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
                    <div class="grid grid-cols-2 gap-2">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Password</span>
                            </label>
                            <input
                                name="password"
                                type="password"
                                placeholder="password"
                                class="input input-bordered"
                            />
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text"
                                    >Password Confirmation</span
                                >
                            </label>
                            <input
                                name="password_confirmation"
                                type="password"
                                placeholder="Password Confirmation"
                                class="input input-bordered"
                            />
                        </div>
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Sign Up</button>
                    </div>
                </form>
                <label class="label mx-auto">
                    <a
                        href="{{ route('user.login') }}"
                        class="label-text-alt link link-hover"
                        >Already have an account? <b>Login</b></a
                    >
                </label>
            </div>
        </div>
    </div>
</div>
@endsection
