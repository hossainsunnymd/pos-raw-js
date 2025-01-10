<button id="modal-button" type="button" data-modal-target="update-product-modal" data-modal-toggle="update-product-modal">update</button>
<!-- Main modal -->
<div id="update-product-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New Category
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="update-product-modal">
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
                        <select name="category" id="update-category"
                            class="border text-sm rounded-lg block w-full p-2.5">
                            <option value="" selected>select category</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="P-name" class="block mb-2 text-sm font-medium "> Name</label>
                        <input type="text" id="P-name" class="border text-sm rounded-lg block w-full p-2.5">
                    </div>

                    <div class="col-span-2">
                        <label for="P-price" class="block mb-2 text-sm font-medium ">price</label>
                        <input type="text" id="P-price" class="border text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="col-span-2">
                        <label for="P-unit" class="block mb-2 text-sm font-medium ">Unit</label>
                        <input type="text" id="P-unit" class="border text-sm rounded-lg block w-full p-2.5">
                    </div>

                    <div class="col-span-2">
                        <label for="P-image" class="block mb-2 text-sm font-medium "> image</label>
                        <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                            id="P-image" class="border text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <img src="" id="oldImg" class="w-[100px]">

                     <div>
                        <input type="text" id="img-url">
                        <input type="text" id="product-id">
                     </div>
                </div>
                <button onclick="updateProduct()" data-modal-toggle="update-product-modal" type="button"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>


<script>
    fillUpdateCategoryDropDown();

    async function fillUpdateCategoryDropDown() {
        let listCategory = await axios.get('list-category');
        listCategory.data.forEach(category => {
            document.getElementById('update-category').innerHTML +=
                `<option value="${category['id']}">${category['name']}</option>`;

        })
    }

    async function showProductUpdateModal(id) {

        let res = await axios.get(`/product-by-id?id=${id}`);
        document.getElementById('oldImg').src = res.data['image'];
        document.getElementById('img-url').value = res.data['image'];
        document.getElementById('product-id').value = res.data['id'];


        document.getElementById('P-price').value = res.data['price'];
        document.getElementById('P-name').value = res.data['name'];
        document.getElementById('P-unit').value = res.data['unit'];
        document.getElementById('update-category').value = res.data['category_id'];
        document.getElementById('modal-button').click();
    }




    async function updateProduct() {


        let filePath=document.getElementById('img-url').value;
        let id= document.getElementById('product-id').value;


       let price= document.getElementById('P-price').value;
       let name=  document.getElementById('P-name').value;
       let unit = document.getElementById('P-unit').value;
       let image = document.getElementById('P-image').files[0];
       let category_id = document.getElementById('update-category').value;

        let formData = new FormData();
        formData.append('name', name);
        formData.append('price', price);
        formData.append('unit', unit);
        formData.append('image', image);
        formData.append('category_id', category_id);
        formData.append('id',id);
        formData.append('file_path',filePath);

        let res = await axios.post('/update-product', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        console.log(res);
        if (res.status === 200 && res.data['status'] === 'success') {
            successToast(res.data['message']);
            await getProduct();
            document.getElementById('update-form').reset();
        } else {
            errorToast(res.data['message']);
        }
    }
</script>
