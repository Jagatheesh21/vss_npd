<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Http\Requests\StoreStageRequest;
use App\Http\Requests\UpdateStageRequest;
use DataTables;
use Illuminate\Http\Request;
class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Stage::latest()->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
       
                               $btn = '<a href="'.route('stage.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
               
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
        return view('stage.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStageRequest $request)
    {
        try {
            $stage = new Stage;
            $stage->name = $request->input('name');
            $stage->description = $request->input('description');
            $stage->save();
            return back()->with('success','Stage Created Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit(Stage $stage)
    {
        return view('stage.edit',compact('stage'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStageRequest  $request
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStageRequest $request, Stage $stage)
    {
        try {
            $stage->name = $request->input('name');
            $stage->description = $request->input('description');
            $stage->save();
            return redirect()->back()->withSuccess('Stage updated Successfully!!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withError($th->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage)
    {
        //
    }
}
