<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateBranch;
use App\Models\{
    Branch,
    Company,
    Location,
};
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private $repository;

    public function __construct(Branch $branch)
    {
        $this->repository = $branch;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = $this->repository->paginate('8');
        $companies = Company::all();
        $locations = Location::all();

        return view('branch.index', compact('branches', 'companies', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $locations = Location::all();

        return view('branch.create', compact('companies', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateBranch $request)
    {
        //dd($request->all());
        $this->repository->create($request->all());

        return redirect()->route('branch.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = $this->repository->find($id);

        $clients = $branch->clients;
        $companies = Company::all();
        $locations = Location::all();

        dd($clients);

        if (!$branch)
            return redirect()->back();


        return view('branch.show', compact('branch', 'companies', 'locations', 'clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = $this->repository->find($id);

        $companies = Company::all();
        $locations = Location::all();

        if (!$branch)
            return redirect()->back();

        return view('branch.edit', compact('branch', 'companies', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateBranch $request, $id)
    {
        $branch = $this->repository->find($id);

        if (!$branch)
            return redirect()->back();

        $branch->update($request->all());

        return redirect()->route('branch.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = $this->repository->find($id);

        if (!$branch)
            return redirect()->back();

        $branch->delete();

        return redirect()->route('branch.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $branches = $this->repository->search($request->filter);

        $companies = Company::all();
        $locations = Location::all();

        return view('branch.index', compact('branches', 'filters', 'companies', 'locations'));
    }
}
