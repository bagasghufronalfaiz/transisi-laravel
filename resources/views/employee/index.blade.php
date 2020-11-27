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
                                {{ __('List of Employee') }}
                            </h1>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('employee.create')}}" class="btn btn-primary btn-sm">Create</a>
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
                                <th scope="col">Company</th>
                                <th scope="col">Email</th>
                                <th scope="col" class="text-right">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $employees as $employee )
                            <tr>
                                <td class="align-middle">{{$employee->nama}}</td>
                                <td class="align-middle">{{$employee->company->nama}}</td>
                                <td class="align-middle">{{$employee->email}}</td>
                                <td class="align-middle text-right">
                                    <a href="{{route('employee.show', ['employee' => $employee->id ])}}" class="btn btn-info btn-sm m-0 text-white" data-toggle="tooltip" title="Show Employee">Show</a>
                                    <a href="{{route('employee.edit', ['employee' => $employee->id ])}}" class="btn btn-warning btn-sm m-0" data-toggle="tooltip" title="Edit Employee">Edit</a>
                                    <form action="{{route('employee.destroy', ['employee' => $employee->id ])}}" method="post" class="m-0 d-inline-block">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Employee">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
