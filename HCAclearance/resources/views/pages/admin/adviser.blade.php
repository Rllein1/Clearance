@extends('layout.master')
@section('title')
    ACD Online Clearance System

@stop

@section('css')

@stop

@section('content')
<!-- Button trigger modal -->
<div class="row">
<button class="btn btn-primary mt-3 ml-1" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size:12px;width:105px;height:35px;">ADD ADVISER</button>
<button class="btn btn-primary mt-3 ml-1" data-bs-toggle="modal" data-bs-target="#csvModal" style="font-size:12px;width:100px;height:35px;">CHOOSE CSV</button>
</div>
<!-- Modal -->
 {!! Toastr::message() !!}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adviser Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                    <form id="adduser" action="{{route('adviser.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control mb-1 shadow" name="fname" placeholder="Enter First Name" required>
                            <input type="text" class="form-control mb-1 shadow" name="lname" placeholder="Enter Last Name" required>
                            <input type="text" class="form-control mb-1 shadow" name="username" placeholder="Enter Username" required>

                            <span class="input-group-btn" style="float: left !important;">
                            <center>
                            <input type="submit" value="ADD Adviser" class="mt-2 btn btn-info text-center">
                            </center>
                        </div>
                    </form>
            </div>
            <p class="fs-6 ml-3 text-muted">Note: The Password is the same with Username!</p>
        </div>
    </div>
    </div>
    <!-- csvmodal -->
    <div class="modal fade" id="csvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Choose CSV File</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <form action="admin/adviser" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label style="font-weight:normal;">CSV File Format should be <b>'fname'</b> for Firstname and <b>'lname'</b> for Lastname.</label>
                        <input type="file" name="file">
                        <br><br>
                        <button type="submit" class="btn btn-primary">Import</button>

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
                <form class="updateform" method="post">
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


    <div class="mt-3 p-2 border-success bg-white ml-1 mr-1" style="border-top: 5px solid ">
    <h4>ADVISERS</h4>
        <table class="table table-bordered yajra-datatable ">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
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
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(function () {

    var table = $('.yajra-datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{route('adviser.getadviser')}}",
        columns: [
            {data: 'fname', name: 'fname'},
            {data: 'lname', name: 'lname'},
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
    function userinfo(id) {
        $(".empmodal").fadeIn();
        $('.updateform').attr('action','http://127.0.0.1:8000/admin/updateuser/'+id+'');
    };
</script>
@stop
