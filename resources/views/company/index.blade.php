@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="h3 my-0 align-middle">
                                {{ __('List of Company') }}
                            </h1>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('company.create')}}" class="btn btn-primary btn-sm">Create</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Website</th>
                                <th scope="col" class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $companies as $company )
                            <tr>
                                <td class="align-middle">{{$company->nama}}</td>
                                <td class="align-middle">{{$company->email}}</td>
                                <td class="align-middle"><img height="50px" width="50px" src="{{ url('/images/'.$company->logo) }}" alt="Logo" title="Logo" /></td>
                                <td class="align-middle">{{$company->website}}</td>
                                <td class="align-middle text-right">
                                    <a href="{{route('company.show', ['company' => $company->id ])}}" class="btn btn-info btn-sm m-0 text-white" data-toggle="tooltip" title="Show Company">Show</a>
                                    <a href="{{route('company.edit', ['company' => $company->id ])}}" class="btn btn-warning btn-sm m-0" data-toggle="tooltip" title="Edit Company">Edit</a>
                                    <form action="{{route('company.destroy', ['company' => $company->id ])}}" method="post" class="m-0 d-inline-block">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Company">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
