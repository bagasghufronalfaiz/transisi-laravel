<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(5);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        // Form Validation
        $validator = $request->validated();

        try {
            $company = Company::findOrFail($request->company);
            Employee::create([
                'nama'          => $request->nama,
                'company_id'    => $request->company,
                'email'         => $request->email,
            ]);

            return redirect()->route('employee.index');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $employee = Employee::findOrFail($id);
        return view('employee.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
         // Form Validation
        $validator = $request->validated();

        try {
            $company = Company::findOrFail($request->company);
            $employee = Employee::findOrFail($id);
            $employee->update([
                'nama'          => $request->nama,
                'company_id'    => $request->company,
                'email'         => $request->email,
            ]);

            return redirect()->route('employee.index');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete kasih try cactc
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index');
    }
}
