<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\PermissionsLabel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DB;

class RolesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('permission:roles-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:roles-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:roles-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('fixed','DESC')
                    ->orderBy('name', 'ASC')
                    ->paginate(5);

        return view('dashboards.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = PermissionsLabel::orderBy('position', 'asc')
                                    ->with(['permission'])
                                    ->get();

        return view('dashboards.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('dashboard.roles.index')
                        ->with('success','New Role Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permissions = PermissionsLabel::orderBy('position', 'asc')
                                    ->with(['permission' => function($query) use ($id){
                                            $query->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id');
                                            $query->where('role_has_permissions.role_id', $id);
                                        }
                                    ])
                                    ->get();

        return view('dashboards.roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = PermissionsLabel::orderBy('position', 'asc')
                                    ->with(['permission'])
                                    ->get();
                                    
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $id)
                                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                ->all();

        return view('dashboards.roles.edit', compact('role', 'permission', 'rolePermissions'));
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
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'. $id,
            'permission' => '',
        ]);

        $role = Role::find($id);
        $role->name = strtolower($request->input('name'));
        $role->save();

        if($role->fixed == 1) {
            $role->syncPermissions(Permission::all());
        }
        else {
            $role->syncPermissions($request->input('permission'));
        }

        return redirect()->route('dashboard.roles.edit', $id)
                        ->with('success', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if($role->fixed == 0) {
            $role->delete();
            return redirect()->route('dashboard.roles.index')
                        ->with('success', 'Role deleted');
        }
        else {
            return redirect()->route('dashboard.roles.index')
                        ->with('error', 'Role deleted');
        }
        
    }
}
