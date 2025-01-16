@extends('layout.sideNav')

@section('contents')
    <div class="max-w-[1400px] mx-auto flex gap-10 p-10  h-screen">
        <div>
            <div class="bg-white border rounded-lg shadow-lg p-3 min-h-[500px] w-[500px]">

                <div class="flex justify-between">
                    <h1 class="text-sm font-bold">Invoice</h1>
                    <div class="text-gray-700">
                        <div>Date: {{ date('Y-m-d') }} </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-bold mb-4">Bill To:</h2>
                    <div class="text-gray-700 mb-2">Name:<span id="name"></span> </div>
                    <div class="text-gray-700">Email: <span id="email"></span></div>
                    <div class="text-gray-700">User Id: <span id="cus_id"></span></div>
                </div>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="invoiceList">

                    </tbody>
                </table>
                <div class="mt-6">
                    <p>Total: <span id="total"></span></p>
                    <p>Payable: <span id="payable"></span></p>
                    <p>Vat: <span id="vat"></span></p>
                    <span id="">Vat(%):</span>
                    <input type="number" step=".25" onkeydown="return false" value="0" min="0"
                        onchange="calculateTotal()" id="vatP" class="h-6 w-20" />
                    <p>Discount: <span id="discount"></span></p>
                    <span class="">Discount(%):</span>
                    <input type="number" step=".25" onkeydown="return false" value="0" min="0"
                        onchange="calculateTotal()" id="discountP" class="h-6 w-20" />
                    <p>
                        <button onclick="createInvoice()"
                            class="mt-10 bg-green-500 hover:bg-green-700 text-white font-bold p-1 rounded">Confirm</button>
                    </p>

                </div>
            </div>

        </div>


        <div>
            <div class="bg-white border rounded-lg shadow-lg px-6 py-8 min-h-[500px] min-w-[500px]">
                <div class="flex justify-between">
                    <h1>Product List</h1>
                    <h1>Pick</h1>
                </div>
                <hr class="mt-5">
                <table class="w-full mb-8 border-spacing-4">
                    <tbody id="productList">

                    </tbody>
                </table>
            </div>
        </div>


        <div>
            <div class="bg-white border rounded-lg shadow-lg px-6 py-8 min-h-[500px] min-w-[500px]">
                <div class="flex justify-between">
                    <h1>Customer List</h1>
                    <h1>Pick</h1>
                </div>
                <hr class="mt-5">
                <table class="w-full mb-8 border-spacing-4">
                    <tbody id="ListCustomer">

                    </tbody>
                </table>
            </div>
        </div>




        <!-- add product toggle -->


        <!-- Main modal -->
        <div id="add-product-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add Product
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4">
                            <div>
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <input hidden id="p-id" />
                                <input type="hidden" id="qty" />
                                <input id="c-name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    readonly />
                            </div>
                            <div>
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" id="p-name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    readonly />
                            </div>
                            <div>
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="text" id="p-price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    readonly />
                            </div>
                            <div>
                                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Qty</label>
                                <input type="text" id="p-qty"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                            </div>
                            <div class="flex justify-between">
                                <button type="button" onclick="add()"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add</button>
                                <button class="bg-red-500 hover:bg-red-600 text-sm rounded-md px-4 text-white"
                                    id="product-modal" data-modal-target="add-product-modal"
                                    data-modal-toggle="add-product-modal" type="button">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <script>
            (async () => {
                customerList();
                productList();
            })();

            const listProduct = [];

            function ShowInvoiceItem() {
                let list = document.getElementById('invoiceList');
                list.innerHTML = "";
                listProduct.forEach((product, i) => {
                    list.innerHTML += `
             <tr>
                <td class="text-center">${i+1}</td>
                <td class="text-center">${product['name']}</td>
                <td class="text-center">${product['price']}</td>
                <td class="text-center">${product['qty']}</td>
                <td class="text-center">${product['total']}</td>
                <td class="text-center"> <button class="bg-red-500 hover:bg-red-600 text-sm rounded-md px-1 text-white" onclick="removeProduct(${i})">Remove</button> </td>
             </tr>
                `
                })
            }

            function removeProduct(i) {
                listProduct.splice(i, 1);
                ShowInvoiceItem();
                calculateTotal();
            }


            async function customerList() {
                let res = await axios.get('/list-customer');
                let customerList = document.getElementById('ListCustomer');
                let row = "";
                res.data.forEach(customer => {

                    row += `
             <tr>
                <td class=" px-8 py-2">${customer['name']}</td>
                <td class="px-4 py-2"> <button onclick="addCustomer('${customer['id']}','${customer['name']}','${customer['email']}')" class="bg-green-500 hover:bg-green-600 rounded-md px-1 text-white">Add</button></td>
             </tr>
                `
                });

                customerList.innerHTML = row;
            }


            function addCustomer(id, name, email) {
                document.getElementById('name').innerHTML = name;
                document.getElementById('email').innerHTML = email;
                document.getElementById('cus_id').innerHTML = id;

            }


            async function productList() {
                let res = await axios.get('/list-product');
                let productList = document.getElementById('productList');
                let row = "";
                res.data.forEach(product => {
                    row += `
             <tr>
                <td class=" px-8 py-2">${product['name']}</td>
                <td class="px-4 py-2"> <button  onclick="addProduct('${product['id']}','${product['name']}','${product['price']}','${product['category']['name']}','${product['unit']}')" class="bg-green-500 hover:bg-green-600 rounded-md px-1 text-white">Add</button></td>
             </tr>
                `
                });

                productList.innerHTML = row;
            }

            async function addProduct(id, name, price, category,qty) {
                document.getElementById('p-id').value = id;
                document.getElementById('qty').value = qty;
                document.getElementById('p-name').value = name;
                document.getElementById('p-price').value = price;
                document.getElementById('c-name').value = category;
                document.getElementById('product-modal').click();

            }


         async function add() {

                let p_id = document.getElementById('p-id').value;
                let name = document.getElementById('p-name').value;
                let price = document.getElementById('p-price').value;
                let qty = document.getElementById('p-qty').value;
                let unit = document.getElementById('qty').value;
                let total = (parseFloat(price) * parseFloat(qty)).toFixed(2);
                document.getElementById('product-modal').click();

                if (qty == '') {
                    errorToast('Please Enter Quantity');
                }else if(qty > unit){
                    errorToast('Product not enough Quantity');

                } else {
                    let existQty=unit-qty;
                    let item = {
                        p_id,
                        name,
                        price,
                        qty,
                        existQty,
                        total
                    };
                    listProduct.push(item);
                    ShowInvoiceItem();
                    calculateTotal();
                    productList();
                }
            }


            function calculateTotal() {
                let total = 0;
                let vatP = (parseFloat(document.getElementById('vatP').value));
                let vat = 0;
                let payable = 0;
                let discount = 0;
                let discountParcent = (parseFloat(document.getElementById('discountP').value));

                listProduct.forEach(product => {
                    total += parseFloat(product['total']);
                })

                if (discountParcent === 0) {
                    vat = parseFloat((total * vatP) / 100).toFixed(2);
                } else {
                    discount = ((total * discountParcent) / 100).toFixed(2);
                    total = (total - discount).toFixed(2);
                    vat = ((total * vatP) / 100).toFixed(2);
                }

                payable = (parseFloat(total) + parseFloat(vat)).toFixed(2);

                document.getElementById('total').innerText = total;
                document.getElementById('vat').innerText = vat;
                document.getElementById('payable').innerText = payable;
                document.getElementById('discount').innerText = discount;
            }


            async function createInvoice() {
                let cus_id = document.getElementById('cus_id').innerHTML;
                let total = document.getElementById('total').innerText;
                let vat = document.getElementById('vat').innerText;
                let payable = document.getElementById('payable').innerText;
                let discount = document.getElementById('discount').innerText;


                if (listProduct.length == 0) {
                    errorToast("Please add product to invoice");

                } else if (cus_id == "") {
                    errorToast("Please select customer");
                } else {
                    let res = await axios.post('/create-invoice', {
                        cus_id: cus_id,
                        total: total,
                        vat: vat,
                        payable: payable,
                        discount: discount,
                        products: listProduct
                    });
                    if (res.data == 1) {
                        successToast("Invoice created successfully");
                        window.location.href = "/invoice-page";
                    }
                }
            }
        </script>
    @endsection
