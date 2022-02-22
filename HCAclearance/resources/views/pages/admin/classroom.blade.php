@extends('layout.master')
@section('title')
    ACD Online Clearance System
@stop

@section('css')

@stop

@section('content')
        <div class="alert alert-danger" id="alert" style="display:none;" role="alert">
                {{$errors->first()}}
        </div>
        <div class="col-4 mt-3">
        {!! Toastr::message() !!}
            <!-- form body -->
            <div class="row p-2 border-primary bg-white" style="border-top: 5px solid">
                <div class="col mx-auto">
                    <div class="">
                        <form class="user" action="{{route('classroom.store')}}" method="post">
                                        @csrf 
                                        <div class="form-group">
                                            <div>
                                                <select class="form-select m-1 shadow " name="grade" id="grade" onchange="change()" required>
                                                    <option value='' selected>Choose grade</option>
                                                    <option value='7'>GRADE-7</option>
                                                    <option value='8'>GRADE-8</option>
                                                    <option value='9'>GRADE-9</option>
                                                    <option value='10'>GRADE-10</option>
                                                    <option value='11'>GRADE-11</option>
                                                    <option value='12'>GRADE-12</option>
                                                </select>
                                            </div>
                                            <div>
                                                <input type="text" class="form-group form-control m-1" name="section" placeholder="Enter Section" required>
                                            </div>
                                            <div>
                                                <select class="form-select m-1 shadow adviser" name="adviser">
                                                    <option value='' selected>Choose adviser</option>
                                                </select> 
                                            </div>        
                                        </div>
                                            <button class="form-control btn-outline-primary" type="submit">Add School-Year</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-8 mt-3">
            <div class="p-2 border-success bg-white" style="border-top: 5px solid">
                <table class="table table-bordered yajra-datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gradelevel</th>
                            <th>Section</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>

        

@stop

@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('classroom.getclassroom')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'grade_level', name: 'grade_level'},
            {data: 'class_name', name: 'class_name'},
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
                url: "{{route('classroom.adviser')}}",                 
            })
            .done(function(teachers){  
                for(i=0;i<teachers.length;i++){
                    $(".adviser").append(
                        "<option value="+teachers[i].id+">"+teachers[i].fname+' '+teachers[i].lname+"</option>"
                    );
                }
            });
    });


    $('document').ready(function(){
        @if($errors->any())
            $("#alert").fadeIn(500).delay(3000).fadeOut(500);
        @endif
    })

  </script>
@stop
