<?php

namespace App\Http\Controllers;

use App\Treatment;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $treatments = DB::table('treatments')
                        ->join('nurslings', 'nurslings.id', '=', 'treatments.nursling_id')
                        ->join('categories', 'categories.id', '=', 'nurslings.category_id')
                        ->select('treatments.*', 'nurslings.owner_name as nurslings_owner_name', 'categories.name as category_name', 'categories.id as category_id');

        if($request->get('status')) {
            $treatments = $treatments->where('treatments.status', $request->get('status'));
        }
        if($request->get('category_id')) {
            $treatments = $treatments->where('category_id', $request->get('category_id'));
        }
        if($request->get('search')) {
            $literals = explode(" ", $request->get('search'));
            foreach($literals as $literal) {
                $treatments = $treatments->where(DB::raw('concat(nurslings.owner_name, categories.name, treatments.complaint)'), 'like', '%' . $literal . '%');
            }
        }
        return view('treatments.index', ['treatments' => $treatments->get(), 'categories' => Category::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nurslings = DB::table('nurslings')
                        ->join('categories', 'categories.id', '=', 'nurslings.category_id')
                        ->select('nurslings.id', 'nurslings.owner_name', 'categories.name as category_name')
                        ->get();
        return view('treatments.create', ['nurslings' => $nurslings]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $treatment = Treatment::create(['complaint' => $request->complaint, 'nursling_id' => $request->nursling_id]);
        if($treatment) {
            return redirect('/treatments');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $treatment = Treatment::findOrFail($id);
        $nurslings = DB::table('nurslings')
                        ->join('categories', 'categories.id', '=', 'nurslings.category_id')
                        ->select('nurslings.id', 'nurslings.owner_name', 'categories.name as category_name')
                        ->get();
        return view('treatments.edit', ['treatment' => $treatment, 'nurslings' => $nurslings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $treatment = Treatment::find($id);

        $treatment->complaint = $request->complaint;
        $treatment->status = $request->status;
        $treatment->nursling_id = $request->nursling_id;

        $treatment->save();

        return redirect('/treatments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
