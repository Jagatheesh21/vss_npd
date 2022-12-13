<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\SubStage;
use App\Http\Requests\StoreSubStageRequest;
use App\Http\Requests\UpdateSubStageRequest;
use DataTables;
use Illuminate\Http\Request;

class SubStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = SubStage::with('stage')->latest()->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
       
                               $btn = '<a href="'.route('sub_stage.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
               
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
        return view('sub_stage.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stages = Stage::get();
        return view('sub_stage.create',compact('stages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubStageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubStageRequest $request)
    {
        try {
            SubStage::create($request->validated());
            return back()->withSuccess('Activity Created Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubStage  $subStage
     * @return \Illuminate\Http\Response
     */
    public function show(SubStage $subStage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubStage  $subStage
     * @return \Illuminate\Http\Response
     */
    public function edit(SubStage $subStage)
    {
        $stages = Stage::select('id','name')->get();
        return view('sub_stage.edit',compact('stages','subStage'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubStageRequest  $request
     * @param  \App\Models\SubStage  $subStage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubStageRequest $request, SubStage $subStage)
    {
        try {
            $subStage->update($request->validated());
            return back()->with('success','SubStage Created Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubStage  $subStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubStage $subStage)
    {
        //
    }
}
