<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fa/all.min.css') }}" rel="stylesheet" />

        <title>{{ $title }}</title>
    </head>
    <body class="bg-slate-200 min-h-screen">
        <div class="navbar bg-base-100 shadow">
            <div class="navbar-start">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost lg:hidden">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16"
                            />
                        </svg>
                    </label>
                    <ul
                        tabindex="0"
                        class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
                    >
                        <li><a>Item 1</a></li>
                        <li tabindex="0">
                            <a class="justify-between">
                                Parent
                                <svg
                                    class="fill-current"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"
                                    />
                                </svg>
                            </a>
                            <ul class="p-2 bg-base-100 rounded-box shadow">
                                <li><a>Submenu 1</a></li>
                                <li><a>Submenu 2</a></li>
                            </ul>
                        </li>
                        <li><a>Item 3</a></li>
                    </ul>
                </div>
                <a class="btn btn-ghost normal-case text-xl">laradaisy</a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal p-0">
                    <li><a>Item 1</a></li>
                    <li tabindex="0">
                        <a>
                            Parent
                            <svg
                                class="fill-current"
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"
                                />
                            </svg>
                        </a>
                        <ul class="p-2 bg-base-100 rounded-box shadow">
                            <li><a>Submenu 1</a></li>
                            <li><a>Submenu 2</a></li>
                        </ul>
                    </li>
                    <li><a>Item 3</a></li>
                </ul>
            </div>
            <div class="navbar-end">
                <div class="form-control">
                    <input
                        type="text"
                        placeholder="Search"
                        class="input w-40 lg:w-80 input-bordered mr-2"
                    />
                </div>
                <div class="dropdown dropdown-end">
                    <label
                        tabindex="0"
                        class="avatar btn btn-circle btn-ghost online placeholder"
                    >
                        <div
                            class="bg-neutral-focus text-neutral-content rounded-full w-12"
                        >
                            <span
                                class="text-xl"
                                >{{ substr(auth()->user()->name, 0, 1) }}</span
                            >
                        </div>
                    </label>
                    <ul
                        tabindex="0"
                        class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52"
                    >
                        <li><a>Settings</a></li>
                        <li><a href="{{ route('user.logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="p-10">
            <div class="alert shadow-lg">
                <div>
                    <span>Welcome, {{ auth()->user()->name }}!</span>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/fa/all.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/chartjs/chart.min.js') }}"></script>
</html>
