
<!-- Main modal -->
<div id="create-product-modal" tabindex="-1" aria-hidden="true"
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
                    data-modal-toggle="create-product-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" id="product-form">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <select name="category" id="category" class="border text-sm rounded-lg block w-full p-2.5">
                            <option value="" selected>select category</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="P-name" class="block mb-2 text-sm font-medium "> Name</label>
                        <input type="text" id="P-name"
                            class="border text-sm rounded-lg block w-full p-2.5">
                    </div>

                    <div class="col-span-2">
                        <label for="P-price" class="block mb-2 text-sm font-medium ">price</label>
                        <input type="text" id="P-price"
                            class="border text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="col-span-2">
                        <label for="P-unit" class="block mb-2 text-sm font-medium ">Unit</label>
                        <input type="text" id="P-unit"
                            class="border text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="col-span-2">
                        <label for="P-image" class="block mb-2 text-sm font-medium "> image</label>
                        <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" id="P-image"
                            class="border text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <img src="" id="newImg" class="w-[100px]">
                </div>
                <button onclick="createProduct()" data-modal-toggle="create-product-modal" type="button"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Create
                </button>
            </form>
        </div>
    </div>
</div>


<script>
    getCategory();

    async function getCategory() {
    let listCategory= await axios.get('list-category');
    listCategory.data.forEach(category => {
     document.getElementById('category').innerHTML += `<option value="${category['id']}">${category['name']}</option>`;

    })
   }

  async function createProduct() {

    let name = document.getElementById('P-name').value;
    let price = document.getElementById('P-price').value;
    let unit = document.getElementById('P-unit').value;
    let image = document.getElementById('P-image').files[0];
    let category_id = document.getElementById('category').value;

    let formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('unit', unit);
    formData.append('image', image);
    formData.append('category_id', category_id);

    let res = await axios.post('/create-product',formData,{
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });
    console.log(res);
    if(res.status===201 && res.data['status']==='success'){
      successToast(res.data['message']);
      await getProduct();
      document.getElementById('product-form').reset();
    }else{
      errorToast(res.data['message']);
    }
  }
</script>
