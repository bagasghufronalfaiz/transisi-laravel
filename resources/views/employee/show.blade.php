@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="h3 my-0 align-middle">
                                {{ __('Show Employee') }}
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                        <div class="col-md-6">
                            <p class="form-control">{{ $employee->nama}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                        <div class="col-md-6">
                            <p class="form-control">{{ $employee->company->nama}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <p class="form-control">{{ $employee->email}}</p>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
