<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateLocation;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $repository;

    public function __construct(Location $location)
    {
        $this->repository = $location;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = $this->repository->orderBy('name')->paginate('8');

        return view('location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLocation $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('location.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = $this->repository->find($id);

        if(! $location)
            return redirect()->back();

        return view('location.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = $this->repository->find($id);

        if(! $location)
            return redirect()->back();

        return view('location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLocation $request, $id)
    {
        $location = $this->repository->find($id);

        if(! $location)
            return redirect()->back();

        $location->update($request->all());

        return redirect()->route('location.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = $this->repository->find($id);

        if(! $location)
            return redirect()->back();

        $location->delete();

        return redirect()->route('location.index');
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
        $locations = $this->repository->search($request->filter);

        return view('location.index', compact('filters', 'locations'));
    }
}
