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
            <!-- form body -->
            <!-- <a href="{{route('schoolyear.destroy',1)}}">hahahahahaha</a> -->
            <div class="row p-2 border-primary bg-white" style="border-top: 5px solid">
                <div class="col mx-auto">
                    <div class="">
                        <form class="user" action="{{route('schoolyear.store')}}" method="post">
                                        @csrf 
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="schoolyear" placeholder="Enter School-year" required>
                                        </div>
                                            <button class="form-control btn-outline-primary" type="submit">Add School-Year</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8 mt-3">
        <div class="p-2 border-success bg-white" style="border-top: 5px solid">
          <table class="table table-hover table-bordered" style="width:100%" id="evalueeTable">
            <thead>
                <tr>
                    <th style="display:none">ID</th>
                    <th class="bg- text-dark">Schoolyear</th>
                    <th class="bg- text-dark">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schoolyears as $schoolyear)
                <tr class="theData">
                    <td style="display: none">{{$schoolyear->id}}</td>
                    <td>{{$schoolyear->schoolyear}}</td>
                    @if($schoolyear->status==1)
                    <td><a href="{{route('schoolyear.update',$schoolyear->id)}}" class="edit btn btn-success btn-sm">Active</a></td>
                    @else
                    <td><a href="{{route('schoolyear.update',$schoolyear->id)}}" class="edit btn btn-danger btn-sm">Inactive</a></td>
                    @endif
                </tr>
                @endforeach
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
<script> 
    $('document').ready(function(){
        @if($errors->any())
            $("#alert").fadeIn(500).delay(3000).fadeOut(500);
        @endif
    })
    function thisdelete(){
    }
    
  </script>
@stop
