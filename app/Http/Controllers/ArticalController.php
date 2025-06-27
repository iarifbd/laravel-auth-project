<?php

namespace App\Http\Controllers;

use App\Models\Artical;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class ArticalController extends Controller implements HasMiddleware
{

    public static function Middleware(): array
    {
        return[
            new Middleware('permission:view articals', only:['index']),
            new Middleware('permission:edit articals', only:['edit']),
            new Middleware('permission:create articals', only:['create']),
            new Middleware('permission:delete articals', only:['destroy']),
        ];

    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articals=Artical::latest()->paginate(10);

        return view('articals.list',[
            'articals'=>$articals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3',
            'author'=>'required|min:3'

        ]);

        if($validator->passes()){

            $artical=new Artical();
            $artical->title =   $request->title;
            $artical->text =   $request->text;
            $artical->author =   $request->author;
            $artical->save();

            return redirect()->route('articals.index')->with('success','Artical added successfully.');

        }else{
            return redirect()->route('articals.create')->withInput()->withErrors($validator);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artical=Artical::findOrFail($id);

        return view('articals.edit',[
            'artical'   =>  $artical
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $artical=Artical::findOrFail($id);

        $validator=Validator::make($request->all(),[
            'title'=>'required|min:3',
            'author'=>'required|min:3'

        ]);

        if($validator->passes()){

            $artical->title =   $request->title;
            $artical->text =   $request->text;
            $artical->author =   $request->author;
            $artical->save();

            return redirect()->route('articals.index')->with('success','Artical updated successfully.');

        }else{
            return redirect()->route('articals.edit',$id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $artical = Artical::find($request->id);

        if ($artical == null) {
            session()->flash('error', 'Artical not found.');
            return response()->json([
            'status' => false,
            'message' => 'Artical not found.'
            ]);
        }

        $artical->delete();

        session()->flash('success', 'Artical deleted successfully.');
        return response()->json([
        'status' => true
        ]);
    }
}
