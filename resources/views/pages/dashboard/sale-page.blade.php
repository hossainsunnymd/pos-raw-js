@extends('layout.sideNav')

@section('contents')

<div class="max-w-[1400px] mx-auto flex gap-10 p-10  h-screen">

        <div class="bg-white border rounded-lg shadow-lg px-6 py-8 h-[500px] w-[500px]">
            <h1 class="font-bold text-2xl my-4 text-center text-blue-600">KRP Services</h1>
            <hr class="mb-2">
            <div class="flex justify-between mb-6">
                <h1 class="text-lg font-bold">Invoice</h1>
                <div class="text-gray-700">
                    <div>Date: 01/05/2023</div>
                    <div>Invoice #: INV12345</div>
                </div>
            </div>
            <div class="mb-8">
                <h2 class="text-lg font-bold mb-4">Bill To:</h2>
                <div class="text-gray-700 mb-2">Name:<span id="name"></span> </div>
                <div class="text-gray-700">Email: <span id="email"></span></div>
                <div class="text-gray-700">User Id: <span id="user_id"></span></div>
            </div>
            <table class="w-full mb-8">
                <thead>
                    <tr>
                        <th class="text-left font-bold text-gray-700">Description</th>
                        <th class="text-right font-bold text-gray-700">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left text-gray-700">Product 1</td>
                        <td class="text-right text-gray-700">$100.00</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="bg-white border rounded-lg shadow-lg px-6 py-8 h-[500px] w-[500px]">
            <h1 class="font-bold text-2xl my-4 text-center text-blue-600">KRP Services</h1>
            <hr class="mb-2">
            <div class="flex justify-between mb-6">
                <h1 class="text-lg font-bold">Invoice</h1>
                <div class="text-gray-700">
                    <div>Date: 01/05/2023</div>
                    <div>Invoice #: INV12345</div>
                </div>
            </div>
            <div class="mb-8">
                <h2 class="text-lg font-bold mb-4">Bill To:</h2>
                <div class="text-gray-700 mb-2">John Doe</div>
                <div class="text-gray-700 mb-2">123 Main St.</div>
                <div class="text-gray-700 mb-2">Anytown, USA 12345</div>
                <div class="text-gray-700">johndoe@example.com</div>
            </div>
            <table class="w-full mb-8">
                <thead>
                    <tr>
                        <th class="text-left font-bold text-gray-700">Description</th>
                        <th class="text-right font-bold text-gray-700">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left text-gray-700">Product 1</td>
                        <td class="text-right text-gray-700">$100.00</td>
                    </tr>
                </tbody>
            </table>
        </div>



        <div class="bg-white border rounded-lg shadow-lg px-6 py-8 h-[500px] w-[500px]">
           <div class="flex justify-between">
           <h1>Customer</h1>
           <h1>Pick</h1>
           </div>
           <hr class="mt-5">
            <table class="w-full mb-8 border-spacing-4">
                <tbody id="customerList">

                </tbody>
            </table>
        </div>




 <script>

    async function customerList(){
        let res = await axios.get('/list-customer');
        let customerList =  document.getElementById('customerList');
        console.log(res);
        let row="";
        res.data.forEach(customer => {

            row+=`
             <tr>
                <td class=" px-8 py-2">${customer['name']}</td>
                <td class="px-4 py-2"> <button onclick="addCustomer('${customer['user_id']}','${customer['name']}','${customer['email']}')" class="text-green-500 px-1 text-white">Add</button></td>
             </tr>
                `
        });

        customerList.innerHTML = row;
    }

    customerList();


    function addCustomer(user_id,name,email){
        document.getElementById('name').innerHTML = name;
        document.getElementById('email').innerHTML = email;
        document.getElementById('user_id').innerHTML = user_id;
    }



 </script>




@endsection
