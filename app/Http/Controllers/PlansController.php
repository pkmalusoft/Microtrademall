<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Exception;

class PlansController extends Controller
{

    /**
     * Display a listing of the plans.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $plans = Plan::paginate(25);

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new plan.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('admin.plans.create');
    }

    /**
     * Store a new plan in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
            
        $data = $this->getData($request,1);
        try {
            Plan::create($data);

            return redirect()->route('plans.plan.index')
                ->with('success_message', 'Plan was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred.']);
        }
    }

    /**
     * Display the specified plan.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $plan = Plan::findOrFail($id);

        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified plan.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        

        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified plan in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $plan = Plan::findOrFail($id);
            $plan->update($data);

            return redirect()->route('plans.plan.index')
                ->with('success_message', 'Plan was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred.']);
        }        
    }

    /**
     * Remove the specified plan from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $plan = Plan::findOrFail($id);
            $plan->delete();

            return redirect()->route('plans.plan.index')
                ->with('success_message', 'Plan was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred.']);
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
            'title' => 'required|string|min:4|max:255',
            'services' => 'required|string|min:1|nullable',
            'price' => 'required|integer|min:2',
            'duration' => 'required|integer|min:5',
            'is_active' => 'boolean|nullable', 
        ];
        if($unique != null){
                $rules['title'] .='|unique:plans';
        }

        
        $data = $request->validate($rules);


        $data['is_active'] = $request->has('is_active');


        return $data;
    }

}
