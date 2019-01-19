@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Keuangan</div>

                <div class="card-body">
                    <b>Jumlah Uang : </b> {{$jumlah_uang}}
                    <hr>
                    <form method="POST" action="{{ route('keuangan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                                <textarea id="keterangan" name="keterangan" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" required="">{{ old('keterangan') }}</textarea>

                                @if ($errors->has('keterangan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-md-4 col-form-label text-md-right">{{ __('Harga') }}</label>

                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control{{ $errors->has('harga') ? ' is-invalid' : '' }}" name="harga" value="{{ old('harga') }}" required>

                                @if ($errors->has('harga'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('harga') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tipe" class="col-md-4 col-form-label text-md-right">{{ __('Tipe') }}</label>

                            <div class="col-md-6">
                                <select name="tipe" class="form-control{{ $errors->has('tipe') ? ' is-invalid' : '' }}" id="tipe" required>
                                    <option @if(old('tipe') == "Pemasukan") selected="" @endif value="Pemasukan">Pemasukan</option>
                                    <option @if(old('tipe') == "Pengeluaran") selected="" @endif value="Pengeluaran">Pengeluaran</option>
                                </select>

                                @if ($errors->has('tipe'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipe') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                                <a class="btn btn-warning" href="{{ route('keuangan') }}"> Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
