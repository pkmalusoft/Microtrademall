<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Exception;

class ServicesController extends Controller
{

    /**
     * Display a listing of the services.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $services = Service::sortable()->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('admin.services.create');
    }

    /**
     * Store a new service in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $this->getData($request, 1);
        if($request->hasFile('icon')) {  
            $file = $request->file('icon');
            $photo = md5(mt_rand(0,100000000000)).'.'.$file->getClientOriginalExtension();
            $file->move(base_path().'/public/media/',$photo);
            $data['icon'] = $photo; 
        }
        try {
            Service::create($data);
            return redirect()->route('services.service.index')
                ->with('success_message', 'Service was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified service.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
            $data = $this->getData($request);
            if($request->hasFile('icon')) {  
                $file = $request->file('icon');
                $photo = md5(mt_rand(0,100000000000)).'.'.$file->getClientOriginalExtension();
                $file->move(base_path().'/public/media/',$photo);
                $data['icon'] = $photo; 
            }

        try {
            $service = Service::findOrFail($id);
            $service->update($data);

            return redirect()->route('services.service.index')
                ->with('success_message', 'Service was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified service from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();

            return redirect()->route('services.service.index')
                ->with('success_message', 'Service was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request, $unique = null)
    {
        $rules = [
                'title' => 'required|string|min:1|max:50',
            'description' => 'string|min:1|max:1000|nullable',
            'icon' => 'nullable|mimes:jpeg,jpg,png,PNG|max:3500',
        ];
        if($unique != null){
            $rules['title'].='|unique:services';
        }
        
        $data = $request->validate($rules);




        return $data;
    }

}
