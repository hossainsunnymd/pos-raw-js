<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.8/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <link rel="stylesheet" href=" {{asset("assets/toastify/toastify.min.css")}} ">
</head>
<body>

    @yield('contents')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
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
