@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Challenge') }}</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('challenge.update', $challenge->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $challenge->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="point" class="col-md-4 col-form-label text-md-right">{{ __('Point') }}</label>

                            <div class="col-md-6">
                                <input id="point" type="number" class="form-control{{ $errors->has('point') ? ' is-invalid' : '' }}" name="point" value="{{ $challenge->point }}" required>

                                @if ($errors->has('point'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('point') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>

                            <div class="col-md-6">
                                <textarea id="note" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" required>{!! $challenge->note !!}</textarea>

                                @if ($errors->has('note'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="flag" class="col-md-4 col-form-label text-md-right">{{ __('Flag') }}</label>

                            <div class="col-md-6">
                                <input id="flag" type="text" class="form-control{{ $errors->has('flag') ? ' is-invalid' : '' }}" name="flag" value="{{ $challenge->flag }}" required>

                                @if ($errors->has('flag'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('flag') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label for="file1" class="col-md-4 col-form-label text-md-right">{{ __('File 1') }}</label>

                            <div class="col-md-6">
                                <input id="file1" type="file" class="form-control{{ $errors->has('file1') ? ' is-invalid' : '' }}" name="file1" value="{{ old('file1') }}" autofocus>
                                @if ($errors->has('file1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file1') }}</strong>
                                    </span>
                                @endif
                                @if ($challenge->file1)
                                <kbd>{{$challenge->file1}}</kbd> <a class="badge badge-danger" href="{{ route('challenge.deleteFile',['id'=>$challenge->id,'file'=>'file1']) }}" title="Delete">X</a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file2" class="col-md-4 col-form-label text-md-right">{{ __('File 2') }}</label>

                            <div class="col-md-6">
                                <input id="file2" type="file" class="form-control{{ $errors->has('file2') ? ' is-invalid' : '' }}" name="file2" value="{{ old('file2') }}" autofocus>
                                @if ($errors->has('file2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file2') }}</strong>
                                    </span>
                                @endif
                                @if ($challenge->file2)
                                <kbd>{{$challenge->file2}}</kbd> <a class="badge badge-danger" href="{{ route('challenge.deleteFile',['id'=>$challenge->id,'file'=>'file2']) }}" title="Delete">X</a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file3" class="col-md-4 col-form-label text-md-right">{{ __('File 3') }}</label>

                            <div class="col-md-6">
                                <input id="file3" type="file" class="form-control{{ $errors->has('file3') ? ' is-invalid' : '' }}" name="file3" value="{{ old('file3') }}" autofocus>
                                @if ($errors->has('file3'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file3') }}</strong>
                                    </span>
                                @endif
                                @if ($challenge->file3)
                                <kbd>{{$challenge->file3}}</kbd> <a class="badge badge-danger" href="{{ route('challenge.deleteFile',['id'=>$challenge->id,'file'=>'file3']) }}" title="Delete">X</a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file4" class="col-md-4 col-form-label text-md-right">{{ __('File 4') }}</label>

                            <div class="col-md-6">
                                <input id="file4" type="file" class="form-control{{ $errors->has('file4') ? ' is-invalid' : '' }}" name="file4" value="{{ old('file4') }}" autofocus>
                                @if ($errors->has('file4'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file4') }}</strong>
                                    </span>
                                @endif
                                @if ($challenge->file4)
                                <kbd>{{$challenge->file4}}</kbd> <a class="badge badge-danger" href="{{ route('challenge.deleteFile',['id'=>$challenge->id,'file'=>'file4']) }}" title="Delete">X</a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                <a class="btn btn-warning" href="{{ route('challenge.index') }}"> Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection