<?php

namespace App\Http\Controllers;

use App\Category;
use App\Nursling;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NurslingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nurslings = DB::table('nurslings')
                        ->join('categories', 'categories.id', '=', 'nurslings.category_id')
                        ->select('nurslings.id', 'nurslings.breed', 'nurslings.address', 'nurslings.nickname', 'nurslings.owner_name', 'categories.name as category_name', 'categories.id as category_id');
        if($request->get('category_id')){
            $nurslings = $nurslings->where('category_id', $request->get('category_id'));
        }
        if($request->get('search')) {
            $literals = explode(" ", $request->get('search'));
            foreach($literals as $literal) {
                $nurslings = $nurslings->where(DB::raw('concat(nurslings.owner_name, nurslings.breed, nurslings.address, nurslings.nickname, categories.name)'), 'like', '%' . $literal . '%');
            }
        }
        return view('nurslings.index', ['nurslings' => $nurslings->get(), 'categories' => Category::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nurslings.create', ['categories' => Category::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nursling = Nursling::create(
            [
                'owner_name'  => $request->owner_name,
                'nickname'  => $request->nickname,
                'address'  => $request->address,
                'breed'  => $request->breed,
                'user_id'     => $request->user_id,
                'category_id' => $request->category_id
            ]
        );
        if($nursling) {
            return redirect('/nurslings');
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
        return view('nurslings.edit', ['categories' => Category::get(), 'nursling' => Nursling::findOrFail($id)]);
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
        $nursling = Nursling::find($id);

        $nursling->user_id = $request->user_id;
        $nursling->category_id = $request->category_id;
        $nursling->owner_name = $request->owner_name;
        $nursling->nickname = $request->nickname;
        $nursling->address = $request->address;
        $nursling->breed = $request->breed;

        $nursling->save();

        return redirect('/nurslings');
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
