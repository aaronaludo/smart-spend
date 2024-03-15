<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LearningFeature;

class LearningFeatureController extends Controller
{
    public function index(){
        $learningFeatures = LearningFeature::all();

        return view('learning-features', compact('learningFeatures'));
    }
    public function add(){
        return view('learning-features-add');
    }
    public function search(Request $request){
        $search = $request->search;
        $learningFeatures = LearningFeature::where('title', 'like', '%' . $search . '%')->get();

        return view('learning-features', compact('learningFeatures', 'search'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('learning-features.add')
                ->withErrors($validator)
                ->withInput();
        }

        $learningFeature = new LearningFeature;
        $learningFeature->title = $request->title;
        $learningFeature->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $learningFeature->image = $path;
        }

        $learningFeature->save();

        return redirect()->route('learning-features.add')->with('success', 'Learning Feature created successfully');
    }
    public function edit($id){
        $learningFeature = LearningFeature::find($id);

        if(!$learningFeature){
            return abort(404);
        }
        return view('learning-features-edit', compact('learningFeature'));
    }
    public function storeEdit(Request $request, $id){
        $learningFeature = LearningFeature::find($id);

        if(!$learningFeature){
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('learning-features.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $learningFeature->title = $request->title;
        $learningFeature->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $learningFeature->image = $path;
        }

        $learningFeature->save();

        return redirect()->route('learning-features.edit', $id)->with('success', 'Learning Feature created successfully');
    }
    public function view($id){
        $learningFeature = LearningFeature::find($id);

        if(!$learningFeature){
            return abort(404);
        }
        
        return view('learning-features-view', compact('learningFeature'));
    }
    public function destroy($id){
        $learningFeature = LearningFeature::find($id);

        if(!$learningFeature){
            return abort(404);
        }

        $learningFeature->delete();

        return redirect()->route('learning-features.index')->with('success', 'Learning Feature delete successfully');
    }
}
