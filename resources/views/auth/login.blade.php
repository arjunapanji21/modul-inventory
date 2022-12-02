<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fa/all.min.css') }}" rel="stylesheet" />

        <title>Laradaisy | Login</title>
    </head>
    <body>
        <div class="hero min-h-screen bg-base-200">
            <div class="hero-content flex-col">
                <div class="text-center">
                    <h1 class="text-5xl font-bold my-10">Login</h1>
                </div>
                <div class="card w-full shadow-2xl bg-base-100">
                    <div class="card-body">
                        <form action="{{ route('user.auth') }}" method="post">
                            @csrf
                            <div class="grid grid-cols-2 gap-2">
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
                            </div>
                            <div class="form-control my-4">
                                <button type="submit" class="btn btn-primary">
                                    Sign In
                                </button>
                            </div>
                        </form>
                        <div class="flex">
                            <label class="label mx-auto">
                                <a
                                    href="{{ route('user.forgot') }}"
                                    class="label-text-alt link link-hover"
                                    >Forgot Password?</a
                                >
                            </label>
                            <div class="divider divider-horizontal"></div>
                            <label class="label mx-auto">
                                <a
                                    href="{{ route('user.register') }}"
                                    class="label-text-alt link link-hover"
                                    >Create Account</a
                                >
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/fa/all.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/chartjs/chart.min.js') }}"></script>
</html>
