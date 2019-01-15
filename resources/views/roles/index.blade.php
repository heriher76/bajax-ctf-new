@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Role Management') }} <a class="btn btn-info btn-sm text-white float-right" href="{{ route('roles.create') }}">+</a></div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif


                    <table class="table table-bordered">
                      <tr>
                         <th>No</th>
                         <th>Name</th>
                         <th width="280px">Action</th>
                      </tr>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-sm text-white btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                    </div>
                                    @can('role-edit')
                                    <div class="col">
                                        <a class="btn btn-sm text-white btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                    </div>
                                    @endcan
                                    @can('role-delete')
                                    @if($role->id != 1 and $role->id != 2 and $role->id != 3 and $role->id != 4)
                                    <div class="col">
                                        <form method="post" action="{{ route('roles.destroy',$role->id) }}?_method=DELETE">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                        </form>
                                    </div>
                                    @endif
                                    @endcan
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection