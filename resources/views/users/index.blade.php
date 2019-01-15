@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users Manajement') }} <a class="btn btn-info btn-sm text-white float-right" href="{{ route('users.create') }}">+</a></div>

                <div class="card-body">
                  @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                  @endif

                  <div class="row">
                    @foreach ($data as $key => $user)
                     <div class="col-md-6">
                      <div class="card">
                        <div class="card-header">{{ $user->name }} <span class="
                          @if($user->visible == true)
                            badge-info
                          @else
                            badge-danger
                          @endif
                         text-white badge float-right">{{ ++$i }}</span></div>
                        <div class="card-body text-center">
                          <img src="{{ $user->getMedia('avatars')->first()->getUrl('thumb') }}" width="100%"> <br>
                          {{ $user->email }} <br>
                          <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a><br>
                          <textarea class="form-control" disabled="">{{ $user->aboutme }}</textarea>

                          @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                               <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                          @endif <br>
                          <hr>
                          <div class="row">
                            <div class="col">
                              <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
                            </div>
                            @can('user-edit')
                            <div class="col">
                              <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
                            </div>
                            @endcan
                            @can('user-delete')
                            @if($user->id != 1)
                            <div class="col">
                              <form method="post" action="{{ route('users.destroy',$user->id) }}?_method=DELETE">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                              </form>
                            </div>
                            @endif
                            @endcan
                          </div>
                        </div>
                      </div>
                     </div>
                    @endforeach
                    <div class="col">
                      {!! $data->render() !!}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection