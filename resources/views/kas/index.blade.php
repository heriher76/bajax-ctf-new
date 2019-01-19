@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kas @can('kas-edit') <a class="btn btn-info btn-sm text-white float-right" href="{{ route('kas.edit') }}?year={{$year}}&month={{$month}}">Edit</a>@endcan</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                      <form action="{{ route('kas') }}" method="GET">
                        <div class="row mb-3">
                            <div class="col-sm-5">
                                <select name="month" class="form-control">
                                  <option @if($month == 1) selected="" @endif value="1">January</option>
                                  <option @if($month == 2) selected="" @endif value="2">February</option>
                                  <option @if($month == 3) selected="" @endif value="3">March</option>
                                  <option @if($month == 4) selected="" @endif value="4">April</option>
                                  <option @if($month == 5) selected="" @endif value="5">May</option>
                                  <option @if($month == 6) selected="" @endif value="6">June</option>
                                  <option @if($month == 7) selected="" @endif value="7">July</option>
                                  <option @if($month == 8) selected="" @endif value="8">August</option>
                                  <option @if($month == 9) selected="" @endif value="9">September</option>
                                  <option @if($month == 10) selected="" @endif value="10">October</option>
                                  <option @if($month == 11) selected="" @endif value="11">November</option>
                                  <option @if($month == 12) selected="" @endif value="12">December</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" placeholder="Year" value="{{$year}}" name="year">
                            </div>
                            <div class="col">
                                <input type="submit" value="Find" class="btn btn-primary float-right">
                            </div>
                        </div>
                      </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">User</th>
                                <th colspan="4">{{$strMonth}} - {{$year}}</th>
                            </tr>
                            <tr>
                                <th width="50">1</th>
                                <th width="50">2</th>
                                <th width="50">3</th>
                                <th width="50">4</th>
                            </tr>
                        </thead>
                        <tbody>                        
                        @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->name}}</td>
                                @if($kas[$user->id]['count'] > 0)
                                @foreach($kas[$user->id]['data'] as $k)
                                    <td>{{ $k->bayar }}</td>
                                @endforeach
                                @else
                                    @for($j=1;$j<=4;$j++)
                                    <td>0</td>
                                    @endfor
                                @endif
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
