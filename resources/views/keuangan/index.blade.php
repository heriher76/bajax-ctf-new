@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Keuangan @can('keuangan-create')<a class="btn btn-info btn-sm text-white float-right" href="{{ route('keuangan.create') }}">+</a>@endcan</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    <b>Jumlah Uang : </b> {{$jumlah_uang}}
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Keterangan</th>
                                <th>Harga</th>
                                <th>Tipe</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>@</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keuangan as $k)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$k->keterangan}}</td>
                                <td>{{$k->harga}}</td>
                                <td>{{$k->tipe}}</td>
                                <td>{{$k->created_at}}</td>
                                <td>{{$k->updated_at}}</td>
                                <td>
                                    <div class="row">
                                    @can('keuangan-edit')
                                    <div class="col">
                                    <a href="{{  route('keuangan.edit',$k->id)  }}" class="btn btn-sm btn-warning">Edit</a>
                                    </div>
                                    @endcan
                                    @can('keuangan-delete')
                                    <div class="col">
                                        <form method="post" action="{{ route('keuangan.destroy',$k->id) }}?_method=DELETE">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                        </form>
                                    </div>
                                    @endcan
                                    </div>
                                </td>
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
