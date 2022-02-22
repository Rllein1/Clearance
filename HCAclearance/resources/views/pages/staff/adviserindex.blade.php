@extends('layout.master')
@section('title')
    ACD Online Clearance System
@stop

@section('css')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="css/adviser_page.css">
 <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
@stop

@section('content')


    <i class="fas fa-user" id="MyClassIcon">
        <a id="adviser_page_css_header">
            My Class List
        </a>
    </i>

    <div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Unclear clearance</th>
            </tr>
        </thead>
        <tbody>
            @foreach(Auth::user()->adviser->advisory->students as $student)
            <tr>
                <td>{{$student->lname}}</td>
                @php ($i = true)
                @foreach($student->student_stat as $status)
                    @if($status->status == 0)
                    @php ($i = false)
                    @endif
                @endforeach
                @if($i == false)
                    <td>pending</td>
                @else
                    <td>cleared</td>
                @endif
                <td>
                    <ul>
                        <div class="row">
                            @foreach($student->student_stat as $status)
                            @if($status->status == 0)
                            <div class="col col-md-6">
                                <li>{{$status->signatory->signatory_name}}</li>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

@stop

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>


@stop
