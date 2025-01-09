<!-- component -->
<div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-12">
    <div class="relative bg-white px-6 pt-10 pb-9 shadow-xl mx-auto w-full max-w-lg rounded-2xl">
      <div class="mx-auto flex w-full max-w-md flex-col space-y-16">
        <div class="flex flex-col items-center justify-center text-center space-y-2">
          <div class="font-semibold text-3xl">
            <p>Email Verification</p>
          </div>
          <div class="flex flex-row text-sm font-medium text-gray-400">
            <p>We have sent a code to your email ba**@dipainhouse.com</p>
          </div>
        </div>

        <div>
          <form action="" method="post">
            <div class="flex flex-col space-y-16">
              <div class="flex flex-row items-center justify-between mx-auto w-full max-w-xs">
                <div class="w-[100%] h-14">
                  <input class="w-full h-full flex items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700" type="text" name="otp" id="otp">
                </div>
              </div>

              <div class="flex flex-col space-y-5">
                <div>
                  <button class="flex flex-row items-center justify-center text-center w-full border rounded-xl outline-none py-5 bg-blue-700 border-none text-white text-sm shadow-sm" type="button" onclick="verifyOtp()">
                    Verify Account
                  </button>
                </div>

                <div class="flex flex-row items-center justify-center text-center text-sm font-medium space-x-1 text-gray-500">
                  <p>Didn't recieve code?</p> <a class="flex flex-row items-center text-blue-600" href="http://" target="_blank" rel="noopener noreferrer">Resend</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    async function verifyOtp() {
        const otp = document.getElementById('otp').value;
        if (otp == "") {
            errorToast("Please enter otp");
        }else{
            const res = await axios.post('/otp-verify', {
                otp: otp,
                email: localStorage.getItem('email')
            })

            if (res.status === 200 && res.data['status'] === "success") {
                successToast(res.data['message']);
                localStorage.clear();
                window.location.href = "/resetPass";

            } else {
                errorToast(res.data['message']);
            }
        }
    }
  </script>
