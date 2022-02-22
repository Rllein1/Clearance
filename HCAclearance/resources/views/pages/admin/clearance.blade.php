@extends('layout.master')
@section('title')
    ACD Online Clearance System

@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
@stop

@section('content')
{!! Toastr::message() !!}
    <div class="alert alert-danger" id="alert" style="display:none;" role="alert">
                {{$errors->first()}}
        </div>
        <div class="mt-3">
                <h4>ACTIVE : {{$schoolyear->schoolyear}}</h4>
        </div>
        <div class="col-4 mt-2">
            <div class="row p-2 border-primary bg-white" style="border-top: 5px solid">
                <div id="createform" class="col mx-auto ">
                    <div class="">
                        <form class="user" action="{{route('clearance.store')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                        <select class="form-select mb-1 gradelevel" onchange="showsem()" name="gradelevel" required>
                                            <option value=''selected>Select Gradelevel</option>
                                            <option value='' disabled style="font-weight: bold;">JHS</option>
                                            <option value='7'>7</option>
                                            <option value='8'>8</option>
                                            <option value='9'>9</option>
                                            <option value='10'>10</option>
                                            <option value='' disabled style="font-weight: bold;">SHS</option>
                                            <option value='11'>11</option>
                                            <option value='12'>12</option>
                                        </select>
                                        <select class="form-select mb-1 shadow sem" style='display:none;' name="sem">
                                            <option value=''selected>Select Semester</option>
                                            <option value='1st'>1st</option>
                                            <option value='2nd'>2nd</option>
                                        </select>
                                        <h5 class="mt-3">Assign Signatory</h5>
                                        <table class="table table-hover table-bordered" style="width:100%" id="tableForm">
                                            <tbody>
                                                @foreach($signatories as $signatory)
                                                <tr>
                                                    <td style="border-style:hidden;"><input type="checkbox" class="checkbox" name="checkbox[]" value="{{$signatory->id}}"></td>
                                                    <td style="border-style:hidden;">{{$signatory->signatory_name}}</td>
                                                    <td style="border-style:hidden;"><select class="select"  name="{{$signatory->id}}preference" data-placeholder="ADD prerequisite" style="width: 100%;">
                                                        @for($i=1;$i <=$count;$i++)
                                                            <option value="{{ $i }}">{{ $i}}</option>
                                                        @endfor
                                                        </select>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        </div>
                                            <button id="formbtn" class="form-control btn-outline-primary" type="submit">Create</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>





        <div class="col-8 mt-2">
        <div class="p-2 border-success bg-white" style="border-top: 5px solid">
          <table class="table table-hover " id="evalueeTable">
            <thead>
                <tr>
                    <th style="display:none">ID</th>
                    <th class=" text-dark">Clearance</th>
                    <th class="display:none"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clearances as $clearance)
                <tr class="theData">
                    <td style="display: none">{{$clearance->id}}</td>
                    @if($clearance->status == 1)
                    <td><a href="" onclick='clearance({{$clearance->id}})' class='' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>{{$clearance->name}}</a><span class="text-bold text-success">  ACTIVE</span></td>
                    @else
                    <td><a href="" onclick='clearance({{$clearance->id}})' class='' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>{{$clearance->name}}</a></td>
                    @endif
                    <td>
                        <i class="dropdown-toggle" type="button" data-toggle="dropdown" ></i>
                        <ul class="dropdown-menu" style="text-decoration: none;">
                            <li><a class="dropdown-item" href="{{route('clearance.update',$clearance->id)}}">Status</a></li>
                            <li><a class="dropdown-item" href="">Update</a></li>
                            <li><a class="dropdown-item" href="{{route('clearance.delete',$clearance->id)}}">Delete</a></li>
                        </ul>
                    </td>
                    <!-- <td><a href="{{route('clearance.update',$clearance->id)}}" class="edit btn btn-danger btn-sm">Inactive</a></td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
      </div>

    <!-- Modal Assignatory-->
    <div class="modal fade p-3" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="clearancelabel">sadasda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="p-5" style="">
                    <table class="table table-bordered m-5 assignatory">
                        <thead>
                            <tr>
                            <th>Assignatories</th>
                            <th>Preference</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
            </div>
        </div>
        </div>
    </div>
    </div>


@stop

@section('script')
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Get Signatory -->
<script>
    $(document).ready(function(){
        $('.select2').select2();
    });

    function showsem() {
        var grade = $.trim($('select[name="gradelevel"]').val());
        if(grade >10 ){
            $('.sem').fadeIn();
        }else{
            $('.sem').fadeOut();
        }
    };

    function clearance(id) {
        var table = $('.assignatory').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        searching:false,
        paging: false,
        info: false,
        ajax: "/clearance/"+id,
        columns: [
            {data: 'name', name: 'name'},
            {data: 'preference', name: 'preference'},
        ]
        });
        table.ajax.url( "/clearance/"+id ).load();
        displayMessage("Event updated");
    };

    $('document').ready(function(){
        @if($errors->any())
            $("#alert").fadeIn(500).delay(3000).fadeOut(500);
        @endif
    })
  </script>

@stop
