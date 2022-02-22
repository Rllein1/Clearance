@extends('layout.master')
@section('title')
    ACD Online Clearance System

@stop

@section('css')

@stop

@section('content')
<!-- Button trigger modal -->
<button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size:12px;width:105px;height:35px;">
  ADD STUDENT
</button>
<button class="btn btn-primary mt-3 ml-1" data-bs-toggle="modal" data-bs-target="#csvModal" style="font-size:12px;width:100px;height:35px;">CHOOSE CSV</button>


<!-- Modal -->
{!! Toastr::message() !!}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <form id="adduser" action="{{route('student.store')}}" method="post">
                    @csrf                        
                    <div class="form-group">
                        <input type="number" class="form-control mb-1 shadow" name="student_id" placeholder="Enter StudentID" required>
                        <input type="text" class="form-control mb-1 shadow" name="fname" placeholder="Enter first name" required>
                        <input type="text" class="form-control mb-1 shadow" name="lname" placeholder="Enter last name" required>

                        <select type="input" class="form-control mb-1 shadow gradelevel" onchange="classes()" name="gradelevel" required>
                            <option value="" disabled selected hidden>Choose Grade-level</option>
                            <option value="7"> GRADE- 7</option>
                            <option value="8"> GRADE- 8</option>
                            <option value="9"> GRADE- 9</option>
                            <option value="10"> GRADE- 10</option>
                            <option value="11"> GRADE- 11</option>
                            <option value="12"> GRADE- 12</option>
                        </select>
                        
                        <select class="form-control mb-1 shadow class" name="class" required>
                            <option value='' selected>Choose Class</option>
                        </select>                     
                                
                        <span class="input-group-btn" style="float: left !important;">
                        <center>
                        <input type="submit" value="ADD STUDENT" class="mt-2 btn btn-info text-center">
                        </center> 
                    </div>
                </form>
        </div>
        </div>
    </div>
    </div>


    <div class="mt-3 mr-3 p-2 border-success bg-white" style="border-top: 5px solid">
    <h1>STUDENT</h1>
        <table class="table table-bordered student-table">
            <thead>
                <tr>
                    <th>StudentID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Grade Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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
                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                            <div class="custom-file text-left">
                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <button class="btn btn-primary">Import data</button>
                        <a class="btn btn-success" href="{{ route('file-export') }}">Export data</a>
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
@stop

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.student-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('student.getstudent')}}",
        columns: [
            {data: 'student_id', name: 'student_id'},
            {data: 'fname', name: 'fname'},
            {data: 'lname', name: 'lname'},
            {data: 'grade', name: 'grade'},
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
    function classes(){
        $(".class").html("<option value=''>Choose Grade-level</option>")
        var grade=$('.gradelevel').val();
        $.ajax({    
                type: 'get',
                url: "{{route('student.studentclassroom')}}",
                data:{ grade: grade},
            })
            .done(function(classes){  
                for(i=0;i<classes.length;i++){
                    $(".class").append(
                        "<option value="+classes[i].id+">"+classes[i].class_name+"</option>"
                    );
                }
            });
    };
    
    function userinfo(id) {
        $(".empmodal").fadeIn();
        $('.updateform').attr('action','http://127.0.0.1:8000/admin/updateuser/'+id+'');
    };
</script>

@stop
