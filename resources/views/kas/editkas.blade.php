@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Kas</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('kas.update') }}">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="year" value="{{$year}}">
                    <input type="hidden" name="month" value="{{$month}}">
                    <table class="table">
                        <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">User</th>
                                <th colspan="4">{{$strMonth}} - {{$year}}</th>
                            </tr>
                            <tr>
                                <th width="100">1</th>
                                <th width="100">2</th>
                                <th width="100">3</th>
                                <th width="100">4</th>
                            </tr>
                        </thead>
                        <tbody>            
                        @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->name}}</td>

                                @if($kas[$user->id]['count'] > 0)
                                @foreach($kas[$user->id]['data'] as $k)
                                <td><input type="number" class="form-control" name="input[{{$user->id}}][{{$k->minggu}}]" value="{{$k->bayar}}" /></td>
                                @endforeach
                                @else
                                    @for($j=1;$j<=4;$j++)
                                <td><input type="number" class="form-control" name="input[{{$user->id}}][{{$j}}]" value="0" /></td>
                                    @endfor
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <center>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                        <a class="btn btn-warning" href="{{ route('kas') }}?year={{$year}}&month={{$month}}"> Back</a>
                    </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
