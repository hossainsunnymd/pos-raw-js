<button id="openModalButton" data-modal-target="invoice-Modal" data-modal-toggle="invoice-Modal" class="btn bg-blue-500 text-white px-4 py-2 rounded-md">
    Open Invoice
</button>

    <div id="invoice-Modal" class="fixed inset-0 hidden flex justify-center items-center bg-gray-500 bg-opacity-50 z-50">
      <div class="bg-white border rounded-lg shadow-lg p-3 h-[600px] w-[600px] p-5">

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
    </div>

    <script>
      async function showInvoiceDetailModal(inv_id,cus_id) {
         let res= await axios.get(`/invoice-detail?inv_id=${inv_id}&cus_id=${cus_id}`);
         console.log(res);
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
    </script>
