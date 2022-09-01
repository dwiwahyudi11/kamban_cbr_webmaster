<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

use App\User;

use DB;
use Hash;
use Image;
use DataTables;
use Form;

class UsersController extends Controller
{

    public function __construct() 
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $users = User::select(['id', 'email', 'name', 'avatar', 'fixed', 'last_login_at', 'last_login_ip']);
            if($request->has('order') == false){
                $users = $users->orderBy('fixed', 'DESC')
                                ->orderBy('name', 'ASC');
            }

            return DataTables::of($users)
                            ->addIndexColumn()
                            ->filter(function ($query) use ($request) {
                                if ($request->has('name')) {
                                    $query->where('name', 'like', "%{$request->get('name')}%");
                                }

                                if ($request->has('email')) {
                                    $query->where('email', 'like', "%{$request->get('email')}%");
                                }
                            })
                            /*->addColumn('roles', function($user) {
                                $roles = ' ';
                                if(!empty($user->getRoleNames())):
                                    foreach($user->getRoleNames() as $role){
                                        $roles .= '<label class="badge badge-primary">'. ucfirst($role) .'</label>';
                                    }
                                endif;
                                return $roles;
                            })*/
                            ->addColumn('action', function($user) {
                                $button = '<div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group mr-2" role="group">
                                            <a class="btn btn-outline-primary" href="'. route('dashboard.users.show', $user->id) .'">Detail</a>';
                                            
                                            if(Auth::user()->id == $user->id || $user->fixed == 0) {
                                                $button .= '<a class="btn btn-primary" href="'. route('dashboard.users.edit', $user->id) .'">Edit</a>';
                                            }
                                $button .= '</div>';
                                
                                $button .= '<div class="btn-group">';
                                    $button .= Form::button('Delete', ['id' => 'button-delete-'. $user->id, 'class' => 'btn btn-danger', 'data-route' => route('dashboard.users.destroy', $user->id) , 'onclick' => 'delete_data('. $user->id .')']);
                                $button .= '</div>';

                                $button .= '</div>';
                                return $button;
                            })
                            ->escapeColumns(['roles, action'])
                            ->toJson();
        }

        return view('dashboards.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = []; //Role::pluck('name', 'name')->all();

        return view('dashboards.users.create', compact('roles'));
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
            'name'      => 'required|string|min:3|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|same:confirm-password',
            // 'roles'    => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        // $user->assignRole($request->input('roles'));

        return redirect()->route('dashboard.users.index')
                        ->with('success', 'Administrator Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('dashboards.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if($user->fixed == 1 && Auth::user()->id != $id) {
            abort(404);
        }
        $roles = []; //Role::pluck('name', 'name')->all();
        $userRole = null; //$user->roles->pluck('name', 'name')->all();

        return view('dashboards.users.edit', compact('user', 'roles', 'userRole'));
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
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'. $id,
            'password'  => 'same:confirm-password',
            // 'roles'     => 'required'
        ]);

        $input = $request->all();
        if(! empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);

        /*if($user->fixed == 0){
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->input('roles'));
        }*/

        return redirect()->route('dashboard.users.edit', $id)
                        ->with('success','Administrator updated');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request) 
    {
        $user = Auth::user();
        return view('dashboards.users.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request, $id) 
    {

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'. $id,
            'password'  => 'same:confirm-password',
        ]);

        $input = $request->all();
        if(! empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            $fileName = Str::slug($input['name']) . '-' . $id . '.'. $avatar->extension();
            
            $image_resize = Image::make($avatar->getRealPath());
            $image_resize->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            })->fit(250);
            $image_resize->save(public_path('uploads/avatars/' .$fileName));

            $input['avatar'] = $fileName;
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('dashboard.profile')
                        ->with('success','Profile updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->fixed != 1) {
            $user->delete();
            return response()->json(['status' => true, 'message' => 'User deleted successfully']);
        }
    }
}
