<?php

namespace App\Http\Controllers;

use App\Models\PartNumber;
use App\Http\Requests\StorePartNumberRequest;
use App\Http\Requests\UpdatePartNumberRequest;
use DataTables;
use Illuminate\Http\Request;

class PartNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = PartNumber::latest()->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
       
                               $btn = '<a href="'.route('part_number.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
               
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
        return view('part_number.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('part_number.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartNumberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartNumberRequest $request)
    {
        try {
            PartNumber::create($request->validated());
            return back()->withSuccess('Part Number Created Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartNumber  $partNumber
     * @return \Illuminate\Http\Response
     */
    public function show(PartNumber $partNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartNumber  $partNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(PartNumber $partNumber)
    {
        return view('part_number.edit',compact('partNumber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartNumberRequest  $request
     * @param  \App\Models\PartNumber  $partNumber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartNumberRequest $request, PartNumber $partNumber)
    {
        try {
            $partNumber->update($request->validated());
            return redirect()->back()->withSuccess('Part Number updated Successfully!!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartNumber  $partNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartNumber $partNumber)
    {
        //
    }
}
