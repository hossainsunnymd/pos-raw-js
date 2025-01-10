<button id="customer-modal" data-modal-target="update-customer-modal" data-modal-toggle="update-customer-modal"></button>
<!-- Main modal -->
<div id="update-customer-modal" tabindex="-1" aria-hidden="true"
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
                data-modal-toggle="update-customer-modal">
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
                    <label for="C-name" class="block mb-2 text-sm font-medium ">Category Name</label>
                    <input type="text" id="C-name" name="C-name"
                        class="border text-sm rounded-lg block w-full p-2.5">
                </div>
                <div class="col-span-2">
                    <label for="C-email" class="block mb-2 text-sm font-medium ">Category Name</label>
                    <input type="text" id="C-email" name="C-email"
                        class="border text-sm rounded-lg block w-full p-2.5">
                </div>
                <div class="col-span-2">
                    <label for="C-mobile" class="block mb-2 text-sm font-medium ">Category Name</label>
                    <input type="text" id="C-mobile" name="C-mobile"
                        class="border text-sm rounded-lg block w-full p-2.5">
                </div>
                <input type="text" hidden id="id">
            </div>
            <button onclick="updateCustomer()"  data-modal-target="update-customer-modal" data-modal-toggle="update-customer-modal" type="button"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
               update
            </button>
        </form>
    </div>
</div>
</div>>


<script>
async function showCustomerUpdateModal(id) {

    let res = await axios.get(`/customer-by-id?id=${id}`);
    document.getElementById('C-name').value=res.data['name'];
    document.getElementById('C-email').value=res.data['email'];
    document.getElementById('C-mobile').value=res.data['mobile'];
    document.getElementById('id').value=res.data['id'];
    document.getElementById('customer-modal').click();
}

async function updateCustomer(){
   let name =document.getElementById('C-name').value;
   let email=document.getElementById('C-email').value;
   let mobile= document.getElementById('C-mobile').value;
   let id= document.getElementById('id').value;
-

    if(res.status===201 && res.data['status']==='success'){
      successToast(res.data['message']);
      await getCustomer();
      document.getElementById('update-form').reset();
    }else{
      errorToast(res.data['message']);
    }
}


</script>
