<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index(){
        $plans = Plan::all();

        return view('plans', compact('plans'));
    }
    public function add(){
        return view('plans-add');
    }
    public function search(Request $request){
        $search = $request->search;
        $plans = Plan::where('title', 'like', '%' . $search . '%')->get();

        return view('plans', compact('plans', 'search'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'minimum_salary' => 'required|integer',
            'minimum_age' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('plans.add')
                ->withErrors($validator)
                ->withInput();
        }

        $plan = new Plan;
        $plan->title = $request->title;
        $plan->description = $request->description;
        $plan->minimum_salary = $request->minimum_salary;
        $plan->minimum_age = $request->minimum_age;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $plan->image = $path;
        }

        $plan->save();

        return redirect()->route('plans.add')->with('success', 'Plan created successfully');
    }
    public function edit($id){
        $plan = Plan::find($id);

        if(!$plan){
            return abort(404);
        }
        return view('plans-edit', compact('plan'));
    }
    public function storeEdit(Request $request, $id){
        $plan = Plan::find($id);

        if(!$plan){
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'minimum_salary' => 'required|integer',
            'minimum_age' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('plans.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $plan->title = $request->title;
        $plan->description = $request->description;
        $plan->minimum_salary = $request->minimum_salary;
        $plan->minimum_age = $request->minimum_age;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $plan->image = $path;
        }

        $plan->save();

        return redirect()->route('plans.edit', $id)->with('success', 'Plan created successfully');
    }
    public function view($id){
        $plan = Plan::find($id);

        if(!$plan){
            return abort(404);
        }
        
        return view('plans-view', compact('plan'));
    }
    public function destroy($id){
        $plan = Plan::find($id);

        if(!$plan){
            return abort(404);
        }

        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plan delete successfully');
    }
}
