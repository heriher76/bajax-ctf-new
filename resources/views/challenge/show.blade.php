@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header @if($challengeLog) bg-success text-white @endif">{{$challenge->name}}  <a class="btn btn-info btn-sm text-white float-right" href="{{ route('challenge.index') }}"><<</a></div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    @if ($message = Session::get('failed'))
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @endif
                    <center><b>{{$challenge->point}} Point</b></center>
                    <hr>
                    {!! $challenge->note !!}
                    <hr>
                    @if($challenge->file1)
                        <a href="{{$urlFile[1]}}" target="_blank">{{$challenge->file1}}</a> <br>
                    @endif
                    @if($challenge->file2)
                        <a href="{{$urlFile[2]}}" target="_blank">{{$challenge->file2}}</a> <br>
                    @endif
                    @if($challenge->file3)
                        <a href="{{$urlFile[3]}}" target="_blank">{{$challenge->file3}}</a> <br>
                    @endif
                    @if($challenge->file4)
                        <a href="{{$urlFile[4]}}" target="_blank">{{$challenge->file4}}</a> <br>
                    @endif
                </div>
                @if(!$challengeLog)
                <div class="card-footer">
                    <form action="{{ route('challenge.cekFlag',['id'=>$challenge->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Flag</span>
                          </div>
                          <input type="text" name="flag" class="form-control" required autofocus>
                          <div class="input-group-prepend">
                            <button class="btn btn-outline-primary" type="submit">Send</button>
                          </div>
                        </div>
                    </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
