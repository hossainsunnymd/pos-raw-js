<button id="update-Modal" data-modal-target="category-update-modal" data-modal-toggle="category-update-modal" class="  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    </button>
<!-- Main modal -->
<div id="category-update-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update Category
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="category-update-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" id="update-form">
                <div class="grid gap-4 mb-4 grid-cols-2">

                    <div class="col-span-2">
                        <label for="category_name" class="block mb-2 text-sm font-medium ">Category Name</label>
                        <input type="text" id="category_name" name="category_name"
                            class="border text-sm rounded-lg block w-full p-2.5">
                        <input type="text" hidden id="category">
                    </div>
                </div>
                <button onclick="updateCategory()" type="button" data-modal-target="category-update-modal" data-modal-toggle="category-update-modal"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                   update
                </button>
            </form>
        </div>
    </div>
</div>>


<script>
 async function showCategoryUpdateModal(id) {
        NProgress.start();
        let res = await axios.get(`/category-by-id?id=${id}`);
        NProgress.done();
        document.getElementById('category_name').value=res.data['name'];
        document.getElementById('category').value=res.data['id'];
        document.getElementById('update-Modal').click();
    }

    async function updateCategory(){
        let name = document.getElementById('category_name').value;
        let id = document.getElementById('category').value;

        let res = await axios.post('/update-category', {name:name,id:id});
        if(res.status===200 && res.data['status']==='success'){
          successToast(res.data['message']);
          await getCategory();
        }else{
          errorToast(res.data['message']);
        }
    }


</script>
