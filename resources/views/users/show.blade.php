@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }} <a class="btn btn-info btn-sm text-white float-right" href="{{ route('users.index') }}"><<</a></div>

                <div class="card-body">
                    <center><img src="{{ $user->getMedia('avatars')->first()->getUrl('thumb') }}"></center>
                    <table class="table">
                        <tr>
                            <th width="150">E-Mail</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Roles</th>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif                                
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Birthplace</th>
                            <td>{{ $user->birthplace }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{ $user->dateofbirth }}</td>
                        </tr>
                        <tr>
                            <th>About Me</th>
                            <td>{{ $user->aboutme }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td><a href="{{ $user->website }}">{{ $user->website }}</a></td>
                        </tr>
                        <tr>
                            <th>Visible</th>
                            <td>{{ $user->visible }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
