<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateClient;
use App\Models\{
    Client,
    Company,
    Branch,
};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    private $repository;

    public function __construct(Client $client)
    {
        $this->repository = $client;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->repository->orderBy('name')->paginate('7');

        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClient $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {
            $nameFile = Str::of($request->name)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('client', $nameFile);
            $data['image'] = $image;
        }

        $this->repository->create($data);

        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->repository->with(['branches', 'branches.company', 'branches.location'])->find($id);

        if (!$client)
            return redirect()->back();

        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = $this->repository->find($id);

        if (!$client)
            return redirect()->back();

        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateClient $request, $id)
    {
        $client = $this->repository->find($id);

        if (!$client)
            return redirect()->back();

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            if (Storage::exists($client->image))
                Storage::delete($client->image);

            $nameFile = Str::of($request->name)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('client', $nameFile);
            $data['image'] = $image;
        }

        $client->update($data);

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = $this->repository->find($id);

        if (!$client)
            return redirect()->back();

        if (Storage::exists($client->image))
            Storage::delete($client->image);

        $client->delete();

        return redirect()->route('client.index');
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
        $clients = $this->repository->search($request->filter);

        return view('client.index', compact('clients', 'filters'));
    }
}
