<?php

namespace App\Http\Controllers;

use App\Models\Service;

use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate();

        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(ServiceRequest $request)
    {
        Service::create($request->validated());

        return redirect()->route('services.index');
    }

    public function show(Service $service) {}

    public function edit(Service $service)
    {
        return view('services.edit');
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('services.index');
    }

    public function destroy(Service $category)
    {
        $category->delete();

        return redirect()->route('services.index');
    }
}
