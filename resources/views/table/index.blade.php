@extends('layouts.app')
@section('content')
<div class="flex text-white items-center max-w-lg bg-purple-500 ">
  <div class="basis-3/5  p-2 text-bold rounded shadow-lg">
    <h5 >
    Table
  </h5>
  </div>
  <a id="addTable" href="#" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
    <i class="fa-solid fa-circle-plus"></i>&nbsp; Add New Table
  </a>
</div>
@endsection

@section('scripts')
<script>
  $(function(){
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
        preConfirm: async (table_no) => {
          try {
            let url = "{{ route('table.store') }}";
            alert(url);
            // response = await fetch(githubUrl);
            // if (!response.ok) {
            //   return Swal.showValidationMessage(`
            //     ${JSON.stringify(await response.json())}
            //   `);
            // }
            // return response.json();
          } catch (error) {
            Swal.showValidationMessage(`
              Request failed: ${error}
            `);
          }
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: `${result.value.login}'s avatar`,
            imageUrl: result.value.avatar_url
          });
        }
      });
    });


    
  });
  
</script>

@endsection
