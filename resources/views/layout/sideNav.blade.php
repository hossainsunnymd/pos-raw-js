<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.8/axios.min.js" integrity="sha512-v8+bPcpk4Sj7CKB11+gK/FnsbgQ15jTwZamnBf/xDmiQDcgOIYufBo6Acu1y30vrk8gg5su4x0CG3zfPaq5Fcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href=" {{asset("assets/toastify/toastify.min.css")}} ">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</head>

<body class="bg-[#fffefe] relative">
    <section>
        <header>
            <!--Nav-->
            <nav aria-label="menu nav" class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

                <div class="flex flex-wrap items-center">
                    <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                        <a href="#" aria-label="Home">
                            <span class="text-xl pl-2"><i class="em em-grinning"></i></span>
                        </a>
                    </div>

                    <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
                        <span class="relative w-full">
                            <input aria-label="search" type="search" id="search" placeholder="Search"
                                class="w-full bg-gray-900 text-white transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal">
                            <div class="absolute search-icon" style="top: 1rem; left: .8rem;">
                                <svg class="fill-current pointer-events-none text-white w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                                    </path>
                                </svg>
                            </div>
                        </span>
                    </div>

                    <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                        <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                            <li class="flex-1 md:flex-none md:mr-3">
                                <a class="inline-block py-2 px-4 text-white no-underline" href="#">Active</a>
                            </li>
                            <li class="flex-1 md:flex-none md:mr-3">
                                <a class="inline-block text-gray-400 no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                                    href="#">link</a>
                            </li>
                            <li class="flex-1 md:flex-none md:mr-3">
                                <div class="relative inline-block">
                                    <button onclick="toggleDD()" class="drop-button text-white py-2 px-2"> <span
                                            class="pr-2"><i class="em em-robot_face"></i></span> Hi, User <svg
                                            class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg></button>
                                    <div id="myDropdown"
                                        class="dropdownlist absolute bg-gray-800 text-white right-0  p-3 w-[200px] overflow-auto z-30 hidden">
                                        <a href="{{url('/profile')}}"
                                            class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i
                                                class="fa fa-user fa-fw"></i> Profile</a>
                                        <a href="#"
                                            class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i
                                                class="fa fa-cog fa-fw"></i> Settings</a>
                                        <div class="border border-gray-800"></div>
                                        <a href="{{url('/logout')}}"
                                            class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i
                                                class="fas fa-sign-out-alt fa-fw"></i> Log Out</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </nav>
        </header>
    </section>

    <section class="mt-[59px]">
        <aside id="default-sidebar"
            class="fixed z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto  bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{url('/dashboard')}}"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">

                            <span class="ms-3 ">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/customer-page"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">

                            <span class="flex-1 ms-3 whitespace-nowrap">Customer</span>
                        </a>
                    </li>
                    <li>
                        <a href="/category-page"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">

                            <span class="flex-1 ms-3 whitespace-nowrap">Category</span>

                        </a>
                    </li>
                    <li>
                        <a href="/sale-page"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">

                            <span class="flex-1 ms-3 whitespace-nowrap">Create Sale</span>
                        </a>
                    </li>
                    <li>
                        <a href="/product-page"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">

                            <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="/invoice-page"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">

                            <span class="flex-1 ms-3 whitespace-nowrap">Invoice</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/login')}}"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">

                            <span class="flex-1 ms-3 whitespace-nowrap">Sign In</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/registration')}}"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">

                            <span class="flex-1 ms-3 whitespace-nowrap">Sign Up</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </section>

        @yield('contents')

    <script>
        function toggleDD() {
            const dropdown = document.getElementById('myDropdown');
            dropdown.classList.toggle('hidden');
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <script src=" {{asset("assets/toastify/toastify-js.js")}} "></script>
    <script>

        function successToast(msg) {
        Toastify({
            gravity: "bottom",
            position: "center",
            text: msg,
            className: "mb-10",
            style: {
                background: "green",
            }
        }).showToast();
    }

    function errorToast(msg) {
        Toastify({
            gravity: "bottom",
            position: "center",
            text: msg,
            className: "mb-5",
            style: {
                background: "red",
            }
        }).showToast();
    }
    </script>
</body>
</html>
