<div class="max-w-4xl mx-auto font-[sans-serif] p-6">
    <form>
      <div class="grid sm:grid-cols-2 gap-8">
        <div>
          <label class="text-gray-800 text-sm mb-2 block">First Name</label>
          <input name="fname" id="fname" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter name" />
        </div>
        <div>
          <label class="text-gray-800 text-sm mb-2 block">Last Name</label>
          <input name="lname" id="lname" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter last name" />
        </div>
        <div>
          <label class="text-gray-800 text-sm mb-2 block">Email Id</label>
          <input name="email" id="email" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter email" />
        </div>
        <div>
          <label class="text-gray-800 text-sm mb-2 block">Mobile No.</label>
          <input name="number" id="number" type="number" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter mobile number" />
        </div>
        <div>
          <label class="text-gray-800 text-sm mb-2 block">Password</label>
          <input name="password" id="password" type="password" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter password" />
        </div>
      </div>

      <div class="!mt-12">
        <button type="button" onclick="register()" class="py-3.5 px-7 text-sm font-semibold tracking-wider rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
          Sign up
        </button>
      </div>
    </form>
  </div>

   <script>
  async function register() {
      const fname = document.getElementById('fname').value;
      const lname = document.getElementById('lname').value;
      const email = document.getElementById('email').value;
      const number = document.getElementById('number').value;
      const password = document.getElementById('password').value;
      if (fname == "" || lname == "" || email == "" || number == "" || password == "") {
          errorToast("Please enter all details");
      } else {
          const res = await axios.post('/user-registration', {
              firstName: fname,
              lastName: lname,
              email: email,
              mobile: number,
              password: password
          });
          if (res.status === 200 && res.data['status'] === "success") {
              successToast(res.data['message']);
              window.location.href = "/login";
          } else {
              errorToast(res.data['message']);
          }
      }
  }
  </script>
