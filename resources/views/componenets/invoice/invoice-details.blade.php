<button id="openModalButton" data-modal-target="invoice-Modal" data-modal-toggle="invoice-Modal" class="btn bg-blue-500 text-white px-4 py-2 rounded-md"></button>

    <div id="invoice-Modal" class="fixed inset-0 hidden flex justify-center items-center bg-gray-500 bg-opacity-50 z-50">
      <div class="bg-white border rounded-lg shadow-lg p-3 flex basis-auto w-1/2">
        <div class="w-full">
            <div id="print-invoice">
                <div class="flex justify-between">
                    <h1 class="text-sm font-bold">Invoice</h1>
                    <div class="text-gray-700">
                        <div> {{Date("Y-m-d")}} </div>
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
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="invoiceProduct">

                    </tbody>
                </table>
                <div class="mt-6">
                    <p>Total: <span id="total"></span></p>
                    <p>Payable: <span id="payable"></span></p>
                    <p>Vat: <span id="vat"></span></p>
                    <p>Discount: <span id="discount"></span></p>

                </div>

              </div>
                <div class="w-full flex justify-end items-end mt-[200px]">
                    <button id="openModalButton" data-modal-target="invoice-Modal" data-modal-toggle="invoice-Modal" class="bg-red-500 text-white m-2 px-4 py-2 rounded-md hover:bg-red-600">Close</button>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 m-2" onclick="printInvoice()">Print</button>
                </div>
              </div>
        </div>
    </div>

    <script>
      async function showInvoiceDetailModal(inv_id,cus_id) {

         NProgress.start();
         let res= await axios.get(`/invoice-detail?inv_id=${inv_id}&cus_id=${cus_id}`);
         NProgress.done();

         let invoiceProduct=document.getElementById('invoiceProduct');
         invoiceProduct.innerHTML = "";
            let row = "";
            res.data.invoice_products.forEach((invoice, index) => {
                row+=`
                    <tr>
                        <td class="text-center"> ${invoice['product']['name']} </td>
                        <td class="text-center"> ${invoice['qty']} </td>
                        <td class="text-center"> ${invoice['sales_price']} </td>
                    </tr>
                `
            })
            invoiceProduct.innerHTML = row;
            document.getElementById('total').innerText=res.data.invoice_detail['total'];
            document.getElementById('payable').innerText=res.data.invoice_detail['payable'];
            document.getElementById('vat').innerText=res.data.invoice_detail['vat'];
            document.getElementById('discount').innerText=res.data.invoice_detail['discount'];
            document.getElementById("openModalButton").click();


            document.getElementById('name').innerText=res.data.customer_detail['name'];
            document.getElementById('email').innerText=res.data.customer_detail['email'];
            document.getElementById('cus_id').innerText=res.data.customer_detail['id'];
        }

        function printInvoice(){
            let printContent=document.getElementById('print-invoice').innerHTML;
            let orginalContenets=document.body.innerHTML;
            document.body.innerHTML=printContent;
            window.print();
            document.body.innerHTML=orginalContenets;
            location.reload();
        }


    </script>

