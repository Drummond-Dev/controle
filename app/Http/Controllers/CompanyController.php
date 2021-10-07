<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCompany;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    private $repository;

    public function __construct(Company $company)
    {
        $this->repository = $company;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->repository->orderBy('name')->paginate('8');

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
     * @param StoreUpdateCompany $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCompany $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {
            $nameFile = Str::of($request->name)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('company', $nameFile);
            $data['image'] = $image;
        }

        $this->repository->create($data);

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
        // $company = $this->repository->find($id);
        $company = $this->repository->with(['branches', 'branches.company', 'branches.location'])->find($id);

        // dd($company);

        if (!$company)
            return redirect()->back();

        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->repository->find($id);

        if (!$company)
            return redirect()->back();

        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCompany $request, $id)
    {
        $company = $this->repository->find($id);

        if (!$company)
            return redirect()->back();

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            if (Storage::exists($company->image))
                Storage::delete($company->image);

            $nameFile = Str::of($request->name)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('company', $nameFile);
            $data['image'] = $image;
        }

        $company->update($data);

        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = $this->repository->find($id);

        if (!$company)
            return redirect()->back();

        if (Storage::exists($company->image))
            Storage::delete($company->image);

        $company->delete();

        return redirect()->route('company.index');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public  function search(Request $request)
    {
        $filters = $request->except('_token');
        $companies = $this->repository->search($request->filter);

        return view('company.index', compact('companies', 'filters'));
    }
}
