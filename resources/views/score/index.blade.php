@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Score Board <b>(TOP 20)</b></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Name</th>
                                <th>Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($score as $s)
                            <tr @if($s->id == Auth::id()) style="font-size: 20px;font-weight: bold" @endif>
                                <td>{{$i++}}</td>
                                <td>{{$s->name}}</td>
                                <td>{{$s->point}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
