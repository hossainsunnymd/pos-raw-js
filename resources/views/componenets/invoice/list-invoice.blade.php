<!-- component -->

<section class="py-1 bg-blueGray-50">
    <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
        <div class=" flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
            <div class="block w-full overflow-x-auto">
                <table class="items-center bg-transparent w-full border-collapse ">
                    <thead>
                        <tr>
                            <th
                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                no
                            </th>
                            <th
                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Name
                            </th>
                            <th
                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Mobile
                            </th>
                            <th
                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Total
                            </th>
                            <th
                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Vat
                            </th>
                            <th
                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Price
                            </th>
                            <th
                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Discount
                            </th>
                            <th
                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Payable
                            </th>

                            <th
                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Action
                            </th>
                        </tr>
                    </thead>

                    <tbody id="invoiceList">

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>

<script>
    getInvoices();
    async function getInvoices() {
        let res = await axios.get('/list-invoice');
        document.getElementById('invoiceList').innerHTML = "";
        let row = "";
        res.data.forEach((invoice, index) => {
            row += `<tr>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${index+1}</td>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${invoice['customer']['name']}</td>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${invoice['customer']['mobile']}</td>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${invoice['total']}</td>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${invoice['vat']}</td>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${invoice['total']}</td>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${invoice['discount']}</td>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${invoice['payable']}</td>
                <td>
                    <button class="p-4" onclick="showInvoiceDetailModal(${invoice['id']},${[invoice['customer_id']]})" > <i class="fa fa-eye"></i> </button>
                    <button onclick="showInvoiceDeleteModal(${invoice['id']})" > <i class="fa fa-trash"></i> </button></td>
                </td>
                `
        });
        document.getElementById('invoiceList').innerHTML = row;
    }
</script>
