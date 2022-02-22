@extends('layout.master')
@section('title')
    ACD Online Clearance System
@stop

@section('css')

@stop

@section('content')
    <div class="mt-4 p-2 border-primary bg-white shadow" style="border-top: 5px solid">
    <h3>Name: {{Auth::user()->student->lname}}, {{Auth::user()->student->fname}}</h3>
    <h3>Grade: {{Auth::user()->student->grade}}</h3>
    <h3>Section:</h3>
    </div>

    <div class="col-8 ">
        <div class="p-2 border-success bg-white" style="border-top: 5px solid">
          <table class="table table-hover table-bordered" style="width:100%" id="evalueeTable">
            <thead>
                <tr>
                    <th style="display:none">ID</th>
                    <th class="bg-info text-dark">Signatory</th>
                    <th class="bg-info text-dark">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->student->student_stat as $status)
                    @if($status->clearance_id == $clearance->id)
                    <tr class="theData">
                        <td style="display: none">{{$status->id}}</td>
                        <td>{{$status->signatory->signatory_name}}</td>
                        <td>{{$status->status}}</td>                          
                    </tr>
                    @endif
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


@stop
