@extends('layouts.app')

@section('content')
<div class="table-responsive">
<table class="table table-bordered">
<th>name</th>
<th>companyname</th>
<th>Address</th>
<th>contactno</th>
@foreach($contacts as $row)
                <tr>
                    <td>{{$row->username}}</td>
                   <td>{{$row->companyname}}</td>
                   <td>{{$row->email}}</td>
                   <td>{{$row->contactno}}</td></tr>
                    
              
            @endforeach

        </table>
    </div>

        @endsection