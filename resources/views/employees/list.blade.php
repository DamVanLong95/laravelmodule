  <!DOCTYPE html>
  <html  lang = "en">
  <head>
  	<meta charset="UTF-8"  name="csrf-token" content="{{ csrf_token() }}">
  	<title>Danh sach nhan vien</title>

  	<!-- Font Awesome -->
  	<link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  	<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.bootstrap.min.css')}}"/>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet"/>


  </head> 
  <body>
  	<div class="container">    
       <br />
       <h3 align="center">Laravel 5.8 Ajax Crud Tutorial - Delete or Remove Data</h3>
       <br />
       @if (session('error'))
       <div class="alert alert-danger">{{ session('error') }}</div>
       @endif
       <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
       </div>
       <br />
     <div class="table-responsive">
      <table class="table table-bordered table-striped" id="user_table">
             <thead>
              <tr>
                  <th width="5%">STT</th>
                  <th width="20%">Name</th>
                  <th width="10%">Salary</th>
                  <th width="20%">Create At</th>
                 	<th width="30%">Update At</th>
                  <th width="40%">Action</th>
              </tr>
             </thead>
       </table>

     </div>
     <br />
     <br />
    </div>
    <div id="formModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Confirmation</h2>
        </div>
        <div class="modal-body">
          <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
        </div>
        <div class="modal-footer">
         <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
       </div>
      </div>
    </div>
  </div>

  <div id="formdata" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Record</h4>
          </div>
          <div class="modal-body">
           <span id="form_result"></span>
           <form method="post" action="{{ route('datatables.store') }}" id="sample_form"  action="" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="control-label col-md-4" > Name : </label>
              <div class="col-md-8">
               <input type="text" name="name" id="name" class="form-control" />
              </div>
             </div>
             <div class="form-group">
              <label class="control-label col-md-4"> Birth date : </label>
              <div class="col-md-8">
               <input type="text" name="birthdate" id="date" class="form-control" placeholder="Please select day, month , year" />
              </div>
             </div>
             <div class="form-group">
              <label class="control-label col-md-4">Select Profile Image : </label>
              <div class="col-md-8">
               <input type="file" name="file" id="file" />
               <span id="store_image"></span>
              </div>
             </div>
             <div class="form-group">
               <div class="radio-inline control-label col-md-4">Gender: </div>
               <div class="col-md-8">
                <label class="radio-inline">
                 <input type="radio" name="gender" checked value="0"> female
               </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="1">male
               </label>
               </div>
             </div>
             <br />
             <div class="form-group" align="center">
              <input type="hidden" name="action" id="action" value="" />
              <input type="submit" name="action_add" id="action_add" class="btn btn-warning" value="add" />
             </div>
           </form>
          </div>
       </div>
      </div>
  </div>


  </body>
  <script src="{{asset('/jquery/dist/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/datatables.min.js')}}"></script>
   <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script type="text/javascript">
    $(function() {
       $('#date').datepicker();

      $('#user_table').DataTable({
          processing: true,
          serverSide: true,
          ordering: true,
          searching: true,
          ajax: '{!! route('datatables.index') !!}',
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'salary', name: 'salary'},
              {data: 'created_at', name: 'created_at'},
              {data:'updated_at', name : 'updated_at'},
              {data:'id',
                render: function(data){
                let html = "<div class='btn-group'>"
                 html += "<a name='edit' type='button' data-id="+data+" class='edit btn btn-success btn-sm'>Edit</a>";
                html += "<a name='delete' type='button' data-id="+data+" class='delete btn btn-warning btn-sm'>Delete</a>";
                html += "</div>"
                return html;
              }

              }

            ],
           "order": [[1, 'asc']]
      });
      $(document).on('click','#create_record',function(){
          $('#action').val("Add");
          $('#formdata').modal('show');

          
      });
      $( "#sample_form" ).submit(function( event ) {
        event.preventDefault();
          var formdata = new FormData($(this)[0]);
            if($('#action').val() == 'Add'){
               $.ajax({
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
              },
               type: "POST",
                url:"{{route('datatables.store')}}",
                data:  formdata,
                processData: false,
                contentType: false,
                success:function(data){

                }

            });
          }
           
      });
      
      // XOA Record
      $(document).on('click','.delete',function(){
        var emp_id = $(this).data('id');
        $('#formModal').modal('show');
        $('#ok_button').on('click',function(){
           $.ajax({
              headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
              },
              url:"{{route('datatables.store')}}"+'/'+ emp_id,
              method:'DELETE',
              success:function(data)
              {
                setTimeout(function(){
                 $('#formModal').modal('hide');
                 $('#user_table').DataTable().ajax.reload();
               }, 100);
              }

           });
        });
      });

  });
    </script>


  </html>