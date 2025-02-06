@extends('layouts.app')
@section('content')
<div class="flex text-white items-center max-w-lg bg-purple-500 ">
  <div class="basis-3/5  p-2 text-bold rounded shadow-lg">
    <h5 >
    Table
  </h5>
  </div>
  <a id="addTable" href="#" class="m-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
    <i class="fa-solid fa-circle-plus"></i>&nbsp; Add New Table
  </a>
</div>
 <table class="w-full text-sm text-left rtl:text-right text-gray-500">
   <tr>
     <th>Sl No</th>
     <th>Table No</th>
     <th>Status</th>
   </tr>
   @foreach ($tables as $table)
   <tr>
     <td>{{ $loop->iteration }}</td>
     <td>{{ $table->table_name }}</td>
     <td>
      <div class="flex items-center mb-4">
          <input {{ $table->status =='active' ? 'checked' : ''}} id="S{{$table->id}}" type="checkbox" value="" 
          class="chkStatus w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
          <label id="L{{$table->id}}" for="" class="ms-2 text-sm font-medium text-gray-900">{{ $table->status }}</label>
      </div>
     </td>
   </tr>
   @endforeach
 </table>
@endsection

@section('scripts')
<script>
  $(function(){
    $('.chkStatus').click(async function(){
        //get the id and remove the S from the id  fetch
        let id = $(this).attr('id').substr(1); 
        let response = await axios.put("{{ route('table.update', ':id') }}".replace(':id', id));
        if(response.status == 200){
          Swal.fire({
            icon: 'success',
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500
          });
          $('#L'+id).text(response.data.seat.status);
        }else{
          Swal.fire({
            icon: 'error',
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500
          });
        }
    })

    $('#addTable').click(function(e){
      e.preventDefault();
      Swal.fire({
        title: "Enter Table Number",
        input: "text",
        inputAttributes: {
          autocapitalize: "off"
        },
        showCancelButton: true,
        confirmButtonText: "Save",
        showLoaderOnConfirm: true,
        preConfirm: async (table_name) => {
          try {
            let url = "{{ route('table.store') }}";
            let data = {
              table_no: table_name
            };
            let response = await axios.post(url, data);
            console.log(response);
            if (response.status == 200) {
              await Swal.fire({
                icon: 'success',
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500
              });
              window.location.reload(); //refresh the page
            }else{
              Swal.fire({
                icon: 'error',
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500
              });
            }
          } catch (error) {
            Swal.fire({
                icon: 'error',
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500
              });
          }
        },
        allowOutsideClick: () => !Swal.isLoading()
      });
    });


    
  });
  
</script>

@endsection
