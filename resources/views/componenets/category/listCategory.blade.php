
<section class="py-1 bg-blueGray-50">
    <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
        <div class="flex justify-between p-5 gap-5">
            <div></div>
            <div class="flex justify-center m-5">
                <button data-modal-target="create-catagory-modal" data-modal-toggle="create-catagory-modal" class="  text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    Create Category
                    </button>
            </div>
        </div>
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
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
                                Category
                            </th>
                            <th
                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Action
                            </th>

                        </tr>
                    </thead>

                    <tbody id="categoryList">

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>

<script>
    getCategory();
    async function getCategory() {
        let res=await axios.get('/list-category');
        document.getElementById('categoryList').innerHTML="";
        let row="";
        res.data.forEach((category,index) => {
             row+=`<tr>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${index+1}</td>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">${category['name']}</td>
                 <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                    <button onclick="showCategoryUpdateModal(${category['id']})"  class="bg-blue-500 px-4 py-2 text-white">Edit</button>
                    <button onclick="showCategoryDeleteModal(${category['id']})" class="bg-red-500 px-4 py-2 text-white">Delete</button>
                </td>
                </tr>`
        });
        document.getElementById('categoryList').innerHTML=row;
    }


</script>
