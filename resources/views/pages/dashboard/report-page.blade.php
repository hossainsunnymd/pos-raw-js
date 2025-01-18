@extends('layout.sideNav')
@section('contents')
   <div class="ml-64 mt-20 p-4">
        <div class="h-[400px] w-[500px] shadow-md rounded-sm border p-4">
           <div>
              <label for="fromDate">From Date:</label>
              <input type="date" name="fromDate" id="fromDate">
           </div>
           <div class="mt-4">
            <label for="fromDate">To Date:</label>
            <input class="ml-4" type="date" name="toDate" id="toDate">
           </div>
           <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-[220px] ml-[330px]" onclick="getReport()">Get Report</button>
        </div>
   </div>

   <script>
    async function getReport() {
        let fromDate = document.getElementById('fromDate').value;
        let toDate = document.getElementById('toDate').value;
        if(fromDate==='' || toDate===''){
            errorToast('Please Select From Date and To Date');
        }else{
            window.location.href = `/report?fromDate=${fromDate}&toDate=${toDate}`

        }
    }
   </script>
@endsection
