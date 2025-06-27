<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller  implements HasMiddleware
{
    public static function Middleware(): array
    {
        return[
            new Middleware('permission:view permissions', only:['index']),
            new Middleware('permission:edit permissions', only:['edit']),
            new Middleware('permission:create permissions', only:['create']),
            new Middleware('permission:delete permissions', only:['destroy']),
        ];

    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions=Permission::orderBy('created_at','DESC')->paginate(10);
        return view('permissions.list',[
            'permissions'=>$permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:permissions|min:3'
        ]);

        if($validator->passes()){
            Permission::create([
                'name'=> $request->name
            ]);

            return redirect()->route('permissions.index')->with('success',"Permission added successfully.");

        }else{
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permission=Permission::findOrFail($id);
        return view('permissions.edit',[
            "permission"=>$permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $permission=Permission::findOrFail($id);

        $validator=Validator::make($request->all(),[
        'name'=>'required|min:3|unique:permissions,name,'.$id.'id'
        ]);

        if($validator->passes()){
            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')->with('success',"Permission updated successfully.");
        }else{
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $permission = Permission::find($id);

        if ($permission == null) {
            session()->flash('error', 'Permission not found.');
            return response()->json([
            'status' => false,
            'message' => 'Permission not found.'
            ]);
        }

        $permission->delete();
        session()->flash('success', 'Permission deleted successfully.');
        return response()->json([
        'status' => true
        ]);
    }
}
