@extends('layout.sideNav')

@section('contents')

<div class="max-w-[1400px] mx-auto flex gap-10 p-10  h-screen">
        <div class="bg-white border rounded-lg shadow-lg p-3 h-[600px] w-[600px]">
            <div class="flex justify-between">
                <h1 class="text-sm font-bold">Invoice</h1>
                <div class="text-gray-700">
                    <div>Date: 01/05/2023</div>
                    <div>Invoice #: INV12345</div>
                </div>
            </div>
            <div>
                <h2 class="text-lg font-bold mb-4">Bill To:</h2>
                <div class="text-gray-700 mb-2">Name:<span id="name"></span> </div>
                <div class="text-gray-700">Email: <span id="email"></span></div>
                <div class="text-gray-700">User Id: <span id="user_id"></span></div>
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
        </div>

        <div class="bg-white border rounded-lg shadow-lg px-6 py-8 h-[600px] w-[600px]">
            <div class="flex justify-between">
            <h1>Customer</h1>
            <h1>Pick</h1>
            </div>
            <hr class="mt-5">
             <table class="w-full mb-8 border-spacing-4">
                 <tbody id="productList">

                 </tbody>
             </table>
         </div>


        <div class="bg-white border rounded-lg shadow-lg px-6 py-8 h-[600px] w-[600px]">
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




<!-- add product toggle -->
<button id="product-modal" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal" type="button">
  </button>

  <!-- Main modal -->
  <div id="add-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                          <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Id</label>
                          <input type="text" id="p-id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" readonly />
                      </div>
                      <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" id="p-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" readonly />
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" id="p-price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" readonly />
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Qty</label>
                        <input type="text" id="p-qty" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  />
                    </div>
                    <button type="button" onclick="add()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add</button>
                  </form>
              </div>
          </div>
      </div>
  </div>




 <script>

   ( async () => {
        customerList();
        productList();
    })();

    const listProduct=[];

     function ShowInvoiceItem(){
         let list=document.getElementById('invoiceList');
         list.innerHTML="";
         listProduct.forEach((product,i) => {
             list.innerHTML+=`
             <tr>
                <td class="text-center">${i+1}</td>
                <td class="text-center">${product['name']}</td>
                <td class="text-center">${product['price']}</td>
                <td class="text-center">${product['qty']}</td>
                <td class="text-center">${product['total']}</td>
                <td class="text-center"> <button class="text-red-500 px-1 text-white" onclick="removeProduct(${i})">Remove</button> </td>
             </tr>
                `
         })
     }

     function removeProduct(i){
         listProduct.splice(i,1);
         ShowInvoiceItem();
     }


    async function customerList(){
        let res = await axios.get('/list-customer');
        let customerList =  document.getElementById('customerList');
        let row="";
        res.data.forEach(customer => {

            row+=`
             <tr>
                <td class=" px-8 py-2">${customer['name']}</td>
                <td class="px-4 py-2"> <button onclick="addCustomer('${customer['id']}','${customer['name']}','${customer['email']}')" class="text-green-500 px-1 text-white">Add</button></td>
             </tr>
                `
        });

        customerList.innerHTML = row;
    }


    function addCustomer(id,name,email){
        document.getElementById('name').innerHTML = name;
        document.getElementById('email').innerHTML = email;
        document.getElementById('user_id').innerHTML = id;

    }


    async function productList(){
        let res = await axios.get('/list-product');
        let productList =  document.getElementById('productList');
        let row="";
        res.data.forEach(product => {
            row+=`
             <tr>
                <td class=" px-8 py-2">${product['name']}</td>
                <td class="px-4 py-2"> <button  onclick="addProduct('${product['id']}','${product['name']}','${product['price']}')" class="text-green-500 px-1 text-white">Add</button></td>
             </tr>
                `
        });

        productList.innerHTML = row;
    }

    async function addProduct(id,name,price){
        document.getElementById('p-id').value = id;
        document.getElementById('p-name').value = name;
        document.getElementById('p-price').value = price;
        document.getElementById('product-modal').click();

    }


    function add(){

       let p_id = document.getElementById('p-id').value;
       let name =  document.getElementById('p-name').value;
       let price = document.getElementById('p-price').value;
       let qty = document.getElementById('p-qty').value;
       let total=(parseFloat(price)*parseFloat(qty)).toFixed(2);
       document.getElementById('product-modal').click();

       let item={p_id,name,price,qty,total};
       listProduct.push(item);
       ShowInvoiceItem();
       console.log(listProduct);

    }



 </script>




@endsection
