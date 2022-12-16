<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fa/all.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/chosen/chosen.css') }}" rel="stylesheet" />

        <title>Toko Jam Kadar | {{ $title }}</title>
    </head>
    <style>
        @media print {
            * {
                display: none;
                visibility: hidden;
            }
            #print-area * {
                display: block;
                visibility: visible;
            }
        }
    </style>
    <body class="bg-base-300 min-h-screen">
        <div class="drawer drawer-mobile">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <input id="menu-toggle" type="checkbox" hidden />
                <!-- Page content here -->
                <div id="show-content">
                    <div class="navbar bg-base-100">
                        <div class="flex-1">
                            <a class="btn btn-ghost normal-case text-xl">{{
                                $title
                            }}</a>
                        </div>
                        <div class="flex-none">
                            <label id="time"></label>
                        </div>
                    </div>
                    @if(session()->has('success'))
                    <div class="px-4 mt-4 -mb-2">
                        <div
                            id="alert"
                            class="alert alert-success animate-bounce shadow-lg"
                        >
                            <div>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="stroke-current flex-shrink-0 h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                <span>{{ session("success") }}</span>
                            </div>
                        </div>
                    </div>
                    @elseif(session()->has('error'))
                    <div class="px-4 mt-4 -mb-2">
                        <div
                            id="alert"
                            class="alert alert-error animate-bounce shadow-lg"
                        >
                            <div>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="stroke-current flex-shrink-0 h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                <span>{{ session("error") }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="p-4">@yield('content')</div>
                </div>

                <!-- Main menu here -->
                <div id="show-menu" class="hidden">
                    <div class="navbar bg-base-100">
                        <div class="flex-1">
                            <a class="btn btn-ghost normal-case text-xl">
                                Menu</a
                            >
                        </div>
                        <div class="flex-none">
                            <label id="time"></label>
                        </div>
                    </div>
                    <div class="grid gap-3 p-5">
                        <a class="">
                            <div class="flex justify-center items-center">
                                <div class="avatar online placeholder">
                                    <div
                                        class="bg-primary-focus text-neutral-content rounded-full w-32"
                                    >
                                        <span
                                            class="text-4xl"
                                            >{{ substr(strtoupper(auth()->user()->name), 0,1) }}</span
                                        >
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card-body text-2xl text-center font-bold capitalize"
                            >
                                {{ auth()->user()->name }}
                            </div>
                        </a>
                        <a
                            href="{{ route('dashboard') }}"
                            class="card bg-base-100 shadow-xl"
                        >
                            <div class="flex justify-center items-center">
                                <i
                                    class="fa-solid text-primary fa-home text-2xl px-10"
                                ></i>
                                <div class="card-body text-xl">Dashboard</div>
                            </div>
                        </a>
                        <div class="divider">Data Barang</div>
                        <a
                            href="{{ route('barang.stok') }}"
                            class="card bg-base-100 shadow-xl"
                        >
                            <div class="flex justify-center items-center">
                                <i
                                    class="fa-solid text-primary fa-box text-2xl px-10"
                                ></i>
                                <div class="card-body text-xl">Stok Barang</div>
                            </div>
                        </a>
                        @if(auth()->user()->role == "Admin")
                        <a
                            href="{{ route('barang.masuk') }}"
                            class="card bg-base-100 shadow-xl"
                        >
                            <div class="flex justify-center items-center">
                                <i
                                    class="fa-solid text-primary fa-arrow-down text-2xl px-10"
                                ></i>
                                <div class="card-body text-xl">
                                    Barang Masuk
                                </div>
                            </div>
                        </a>
                        <a
                            href="{{ route('barang.keluar') }}"
                            class="card bg-base-100 shadow-xl"
                        >
                            <div class="flex justify-center items-center">
                                <i
                                    class="fa-solid text-primary fa-arrow-up text-2xl px-10"
                                ></i>
                                <div class="card-body text-xl">
                                    Barang Keluar
                                </div>
                            </div>
                        </a>
                        <div class="divider">Laporan</div>
                        <a
                            href="{{ route('laporan') }}"
                            class="card bg-base-100 shadow-xl"
                        >
                            <div class="flex justify-center items-center">
                                <i
                                    class="fa-solid text-primary fa-file-invoice text-2xl px-10"
                                ></i>
                                <div class="card-body text-xl">
                                    Laporan Stok Barang
                                </div>
                            </div>
                        </a>
                        @endif
                        <div class="divider">Pengaturan</div>
                        <!-- <a href="" class="card bg-base-100 shadow-xl">
                            <div class="flex justify-center items-center">
                                <i
                                    class="fa-solid text-primary fa-user text-2xl px-10"
                                ></i>
                                <div class="card-body text-xl">Data User</div>
                            </div>
                        </a>
                        <a href="" class="card bg-base-100 shadow-xl">
                            <div class="flex justify-center items-center">
                                <i
                                    class="fa-solid text-primary fa-lock text-2xl px-10"
                                ></i>
                                <div class="card-body text-xl">
                                    Ubah Password
                                </div>
                            </div>
                        </a> -->
                        <a
                            href="{{ route('user.logout') }}"
                            class="card bg-base-100 shadow-xl"
                        >
                            <div class="flex justify-center items-center">
                                <i
                                    class="fa-solid text-primary fa-sign-out text-2xl px-10"
                                ></i>
                                <div class="card-body text-xl">Keluar</div>
                            </div>
                        </a>
                    </div>
                </div>
                <footer class="footer footer-center p-4 text-base-content">
                    <div>
                        <p>
                            Copyright © 2022 - All right reserved by Toko Jam
                            Kadar Jambi
                        </p>
                    </div>
                </footer>
            </div>
            <div class="btm-nav lg:hidden">
                <a
                    href="{{ route('dashboard') }}"
                    class="bg-primary-focus text-primary-content @if($title == 'Scan QR') active @endif"
                >
                    <i class="fa-solid fa-qrcode"></i>
                    <span class="btm-nav-label">Scan QR</span>
                </a>
                <button
                    id="btn-menu"
                    onclick="btn_menu()"
                    class="bg-primary-focus text-primary-content"
                >
                    <i class="fa-solid fa-bars"></i>
                    <span class="btm-nav-label">Menu</span>
                </button>
            </div>
            <div class="drawer-side">
                <label for="my-drawer-2" class="drawer-overlay"></label>
                <ul
                    class="menu p-4 w-60 text-xl bg-primary-focus shadow-xl text-primary-content"
                >
                    <!-- Sidebar content here -->
                    <li class="p-1">
                        <a class="capitalize font-bold"
                            ><i class="fa-solid fa-user"></i>
                            {{ auth()->user()->name }}</a
                        >
                    </li>
                    <li class="p-1">
                        <a href="{{ route('dashboard') }}" class=""
                            >Dashboard</a
                        >
                    </li>
                    <div onclick="menu_barang()" class="collapse">
                        <input id="collapse-barang" type="checkbox" />
                        <div
                            class="collapse-title flex justify-between items-center text-xl pl-5"
                        >
                            Data Barang
                            <i
                                id="icon-data-barang"
                                class="fa-solid fa-caret-down"
                            ></i>
                        </div>
                        <div class="collapse-content">
                            <li class="p-1">
                                <a
                                    href="{{ route('barang.stok') }}"
                                    class="@if($title == 'Data Stok Barang') active @endif"
                                    >Stok Barang</a
                                >
                            </li>
                            @if(auth()->user()->role == "Admin")
                            <li class="p-1">
                                <a
                                    href="{{ route('barang.masuk') }}"
                                    class="@if($title == 'Data Barang Masuk') active @endif"
                                    >Barang Masuk</a
                                >
                            </li>
                            <li class="p-1">
                                <a
                                    href="{{ route('barang.keluar') }}"
                                    class="@if($title == 'Data Barang Keluar') active @endif"
                                    >Barang Keluar</a
                                >
                            </li>
                            @endif
                        </div>
                    </div>
                    <!-- <div onclick="menu_laporan()" class="collapse">
                        <input id="collapse-laporan" type="checkbox" />
                        <div
                            class="collapse-title flex justify-between items-center text-xl pl-5"
                        >
                            Laporan
                            <i
                                id="icon-laporan"
                                class="fa-solid fa-caret-down"
                            ></i>
                        </div>
                        <div class="collapse-content">
                            <li class="p-1">
                                <a href="" class="">Stok Barang</a>
                            </li>
                            <li class="p-1">
                                <a href="" class="">Barang Masuk</a>
                            </li>
                            <li class="p-1">
                                <a href="" class="">Barang Keluar</a>
                            </li>
                        </div>
                    </div> -->
                    @if(auth()->user()->role == "Admin")
                    <li class="p-1">
                        <a href="{{ route('laporan') }}" class="">Laporan</a>
                    </li>
                    <div onclick="menu_barang()" class="collapse">
                        <input id="collapse-barang" type="checkbox" />
                        <div
                            class="collapse-title flex justify-between items-center text-xl pl-5"
                        >
                            Master Data
                            <i
                                id="icon-data-barang"
                                class="fa-solid fa-caret-down"
                            ></i>
                        </div>
                        <div class="collapse-content">
                            <li class="p-1">
                                <a
                                    href="{{ route('master.kategori') }}"
                                    class="@if($title == 'Kategori') active @endif"
                                    >Kategori</a
                                >
                            </li>
                            <li class="p-1">
                                <a
                                    href="{{ route('master.users') }}"
                                    class="@if($title == 'Users') active @endif"
                                    >Users</a
                                >
                            </li>
                        </div>
                    </div>
                    @endif
                    <li class="p-1">
                        <a href="{{ route('user.logout') }}"
                            ><i class="fa-solid fa-sign-out"></i> Keluar</a
                        >
                    </li>
                </ul>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/fa/all.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('js/chosen/chosen.jquery.min.js') }}"></script>
    <script>
        $(".chosen-single").chosen({
            width: "100%",
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#table-search tr").filter(function () {
                    $(this).toggle(
                        $(this).text().toLowerCase().indexOf(value) > -1
                    );
                });
            });

            setTimeout(function () {
                $("#alert").addClass("hidden");
            }, 3000);
        });
        function menu_barang() {
            if ($("#collapse-barang").is(":checked")) {
                $("#icon-data-barang").removeClass("fa-caret-down");
                $("#icon-data-barang").addClass("fa-caret-up");
            } else {
                $("#icon-data-barang").removeClass("fa-caret-up");
                $("#icon-data-barang").addClass("fa-caret-down");
            }
        }

        function menu_laporan() {
            if ($("#collapse-laporan").is(":checked")) {
                $("#icon-laporan").removeClass("fa-caret-down");
                $("#icon-laporan").addClass("fa-caret-up");
            } else {
                $("#icon-laporan").removeClass("fa-caret-up");
                $("#icon-laporan").addClass("fa-caret-down");
            }
        }

        function btn_menu() {
            $("#menu-toggle").click();
            if ($("#menu-toggle").is(":checked")) {
                $("#btn-menu").addClass("active");
                $("#show-menu").removeClass("hidden");
                $("#show-content").addClass("hidden");
            } else {
                $("#show-menu").addClass("hidden");
                $("#show-content").removeClass("hidden");
                $("#btn-menu").removeClass("active");
            }
        }
    </script>
</html>
