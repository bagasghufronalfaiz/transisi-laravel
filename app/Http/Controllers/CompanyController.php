<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(5);
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        // Form Validation
        $validator = $request->validated();

        // Image Handle
        $logoName = $request->nama . '-' . date('YmdHis') . '.' . $request->logo->extension();
        $request->logo->storeAs('company', $logoName);

        // Save to database
        Company::create([
            'nama'      => $request->nama,
            'email'     => $request->email,
            'logo'      => $logoName,
            'website'   => $request->website
        ]);

        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $company = Company::findOrFail($id);
            return view('company.show', compact('company'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $company = Company::findOrFail($id);
            return view('company.edit', compact('company'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        // Form Validation
        $validator = $request->validated();

        try {
            $company = Company::findOrFail($id);

            // Save image
            $logoName = $request->nama . '-' . date('YmdHis') . '.' . $request->logo->extension();
            $request->logo->storeAs('company', $logoName);

            // Update database
            $company->update([
                'nama'      => $request->nama,
                'email'     => $request->email,
                'logo'      => $logoName,
                'website'   => $request->website
            ]);

            return redirect()->route('company.index');
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
        try {
            $company = Company::findOrFail($id);
            $company->delete();
            return redirect()->route('company.index');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

    }
}
