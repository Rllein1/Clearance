@extends('layout.master')
@section('title')
    ACD Online Clearance System
@stop

@section('css')

@stop

@section('content')
<!-- Button trigger modal -->
<button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size:12px;width:118px;height:35px;">
  ADD SIGNATORY
</button>
<!-- Modal -->
<!-- {!! Toastr::message() !!} -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <form id="adduser" action="{{route('signatory.store')}}" method="post">
                    @csrf                        
                    <div class="form-group">
                        <input type="text" class="form-control mb-1 shadow" name="signatory_name" placeholder="Enter Signatory" required>         
                        <input type="text" class="form-control mb-1 shadow" name="username" placeholder="Enter Username" required>   
                        <span class="input-group-btn" style="float: left !important;">
                        <center>
                        <input type="submit" value="ADD Signatory" class="mt-2 btn btn-info text-center">
                        </center> 
                    </div>
                </form>
        </div>
        </div>
    </div>
    </div>

    <!-- EmployeeModal -->
    <div class="modal empmodal" id="employeeModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title username" id="exampleModalLabel"></h5>
            <button type="button" class="btn-close" onclick="$(this).click($('.empmodal').fadeOut())"></button>
        </div>
        <div class="modal-body">
                <form class="updateform"  method="post">
                    @csrf                        
                    <div class="form-group">
                        <input type="password" class="form-control mb-1 shadow " name="newpassword" placeholder="Enter New Password" required>
                        <span class="input-group-btn" style="float: left !important;">
                        <center>
                        <input type="submit" value="Reset Password" class="mt-2 btn btn-info text-center">
                        </center> 
                    </div>
                </form>
        </div>
        </div>
    </div>
    </div>


    <div class="mt-3 mr-3 p-2 border-success bg-white" style="border-top: 5px solid">
    <h1>SIGNATORY</h1>
        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@stop

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('signatory.getsignatory')}}",
        columns: [
            {data: 'signatory_name', name: 'signatory_name'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>
<script>
    $(function(){
            $.ajax({    
                type: 'get',
                url: "#",                 
            })
            .done(function(incharges){  
                for(i=0;i<incharges.length;i++){
                    $(".incharge").append(
                        "<option value="+incharges[i].id+">"+incharges[i].fname+' '+incharges[i].lname+"</option>"
                    );
                }
            });
    });     
    function userinfo(id) {
        $(".empmodal").fadeIn();
        
        $.ajax({    
                type:"GET",
                url: ""+id,             
                dataType: "json",                  
                success: function(response){
                    $('.username').html(response.name);
                    $('.updateform').attr('action','http://127.0.0.1:8000/admin/updateuser/'+response.id+'');                                 
                }
                    
            });
    };
    function userinfo(id) {
        $(".delmodal").fadeIn();
        
        $.ajax({    
                type:"GET",
                url: ""+id,             
                dataType: "json",                  
                success: function(response){
                    $('.username').html(response.name);
                    $('.updateform').attr('action','http://127.0.0.1:8000/admin/updateuser/'+response.id+'');                                 
                }
                    
            });
    };
</script>

@stop
