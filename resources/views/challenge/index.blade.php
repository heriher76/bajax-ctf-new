@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Challenges @can('challenge-create')<a class="btn btn-info btn-sm text-white float-right" href="{{ route('challenge.create') }}">+</a>@endcan</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    <div class="alert alert-warning">
                      Format Flag BAJAX[w+]
                    </div>
                    <div class="row">
                    @foreach ($challenges as $challenge)
                     <div class="col-md-4 mb-3">
                      <div class="card">
                        <div class="card-header @if($challenge['finished']) bg-success text-white @endif">{{ $challenge['data']->name }}</div>
                        <div class="card-body text-center">
                          <b style="font-size: 60px;">{{$challenge['data']->point}}</b><br>
                          POINT
                        </div>
                        <div class="card-footer">
                          <div class="row">
                            <div class="col">
                              <a class="btn btn-info btn-sm" href="{{ route('challenge.show',$challenge['data']->id) }}">Show</a>
                            </div>
                            @can('challenge-edit')
                            <div class="col">
                              <a class="btn btn-primary btn-sm" href="{{ route('challenge.edit',$challenge['data']->id) }}">Edit</a>
                            </div>
                            @endcan
                            @can('challenge-delete')
                            <div class="col">
                              <form method="post" action="{{ route('challenge.destroy',$challenge['data']->id) }}?_method=DELETE">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                              </form>
                            </div>
                            @endcan
                          </div>
                        </div>
                      </div>
                     </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
