<section class="w-full bg-white mx-auto max-w-[1300px]">
    <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Products</h2>
                           <p class="font-bold text-3xl"> <span id="product"></span> <span class="text-green-500"></span></p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>

            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Category</h2>
                            <p class="font-bold text-3xl"> <span id="category"></span> <span class="text-pink-500"></span></p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>

            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Customers</h2>
                            <p class="font-bold text-3xl"> <span id="customer"></span> <span class="text-yellow-600"></span></p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>

            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Invoices</h2>
                            <p class="font-bold text-3xl"> <span id="invoice"></span> </p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>

            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div class="bg-gradient-to-b from-indigo-200 to-indigo-100 border-b-4 border-indigo-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Total Sale</h2>
                            <p class="font-bold text-3xl"> <span id="sale"></span> </p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>

            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Vat Collection</h2>
                            <p class="font-bold text-3xl"> <span id="vat"></span> <span class="text-red-500"></span></p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>


            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Total Collection</h2>
                            <p class="font-bold text-3xl"> <span id="total"></span> <span class="text-red-500"></span></p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>


    </div>
</section>


<script>
    async function getData() {
        NProgress.start();
        let res= await axios.get('/summary');
        NProgress.done();
        document.getElementById('product').innerHTML=res.data['product'];
        document.getElementById('category').innerHTML=res.data['category'];
        document.getElementById('customer').innerHTML=res.data['customer'];
        document.getElementById('invoice').innerHTML=res.data['invoice'];
        document.getElementById('sale').innerHTML=res.data['total'];
        document.getElementById('vat').innerHTML=res.data['vat'];
        document.getElementById('total').innerHTML=res.data['payable'];
    }

    getData();
</script>
