<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\UtilityFunctions;
use App\Models\District;
use App\Models\State;
use App\Http\Requests\CreateUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     abort_unless(Gate::allows('hasPermission', 'view_users'), 403);

    //     if (User::isAdmin()) {

    //         $users = User::with('roles')->whereNotIn('role', [1, 2])->get();

    //         return view('admin.user.index', ['users' => $users]);

    //     } else if (User::isSuperAdmin()) {

    //         $users = User::with('roles')->whereNotIn('role', [1])->get();

    //         return view('admin.user.index', ['users' => $users]);
    //     } 
    // }

    public function index()
    {
        abort_unless(Gate::allows('hasPermission', 'view_users'), 403);

        if (User::isSuperSuperAdmin()) {
            // Super Super Admins have access to all users
            $users = User::with('roles')->get();
        } elseif (User::isSuperAdmin()) {
            // Super Admins have access to users with roles other than 1 (Super Super Admin)
            $users = User::with('roles')->where('role', '!=', 1)->get();
        } else {
            // Regular Admins (role 3) have access to users with roles other than 1 and 2 (Super Super Admin and Super Admin)
            $users = User::with('roles')->whereNotIn('role', [1, 2])->get();
        }

        return view('admin.user.index', ['users' => $users]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'create_users'), 403);

        if (User::isSuperSuperAdmin()) {
            $role = Role::whereNotIn('id', [1])->get();

            $districts = District::get();

            $states = State::get();

            return view('admin.user.create', [
                'role'      => $role,
                'districts' => $districts,
                'states'    => $states
            ]);
        }
        

        if (User::isSuperAdmin()) {

            $role = Role::whereNotIn('id', [1, 2])->get();

            $districts = District::get();

            $states = State::get();

            return view('admin.user.create', [
                'role'      => $role,
                'districts' => $districts,
                'states'    => $states
            ]);
        } 
        // else {

        //     $role = Role::whereNotIn('id', [1, 2])->get();

        //     return view('admin.user.create', ['role' => $role]);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        // dd($request->all);
        abort_unless(Gate::allows('hasPermission', 'create_users'), 403);
        try {

            $user = new User;

            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->mobile_no = $request['mobile_no'];
            $user->office = $request['office'];
            $user->role = $request['role'];
            $user->password = Hash::make($request['password']);
            $user->is_active = $request['is_active'];
            $user->district_id = $request['district_id'];
            $user->state_id = $request['state_id'];

            if ($user->save()) {
                History::create([
                    'description' => 'Created User with id ' . $user->id,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
                return redirect()->route('admin.users.index')->with('success', 'Success!! User Created');
            }
        } catch (\Exception) {
            return Redirect::back()->with('error', 'Error!! User not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function viewDeleted(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'view_deleted_users'), 403);

        if (User::isAdmin()) {

            $users = User::onlyTrashed()->with('roles')->whereNotIn('role', [1, 2])->get();

            return view('admin.user.deleted', ['users' => $users]);
        } else if (User::isSuperAdmin()) {

            $users = User::onlyTrashed()->with('roles')->whereNotIn('role', [1])->get();

            return view('admin.user.deleted', ['users' => $users]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission', 'update_users'), 403);

        abort_unless(Gate::allows('hasUpdateUserPermission', $id), 403);

        $role = UtilityFunctions::getRole();

        $user = User::with('roles')->whereIn('id', [$id])->first();

        // Getting all districts except 'All districts'
        $districts = District::all();
        $states = State::all();

        return view('admin.user.update', [
            'role' => $role,
            'user' => $user,
            'districts' => $districts,
            'states' => $states

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'update_users'), 403);

        abort_unless(Gate::allows('hasUpdateUserPermission', $request->id), 403);

        try {

            $user = User::find($request->id);

            $this->validate($request, [
                'name' => 'required|min:3|regex:/[a-zA-Z]/',
                'email' => ['required', Rule::unique('users')->ignore($request->id)],
                'role' => 'required',
                'is_active' => 'required',
                'state_id' => 'nullable',
                'district_id' => 'nullable',
            ]);

            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->mobile_no = $request['mobile_no'];
            $user->office = $request['office'];
            $user->role = $request['role'];
            $user->password = Hash::make($request['password']);
            $user->is_active = $request['is_active'];
            $user->district_id = $request['district_id'];
            $user->state_id = $request['state_id'];

            // dd($user);
            if ($user->update()) {

                History::create([
                    'description' => 'Update user with user id ' . $request['id'],
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);

                return redirect()->route('admin.users.index')->with('success', 'Success!! User Information Updated');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error!! User Information Not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission', 'delete_users'), 403);

        try {

            $user = User::find($id);
            if ($user->delete()) {
                History::create([
                    'description' => 'Soft Deleted user with user id ' . $id,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
                return redirect()->route('admin.users.index')->with('success', 'Success!! User Deleted');
            }
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Error!! Failed to delete user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function permanentDestroy($id)
    {

        abort_unless(Gate::allows('hasPermission', 'permanent_delete_users'), 403);

        try {
            $user = User::withTrashed()->find($id);
            if ($user->forceDelete()) {
                History::create([
                    'description' => 'Permanent Deleted user with user id ' . $id,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
                return Redirect()->route('admin.users.index')->with('success', 'Success!! User Deleted Permanently');
            }
        } catch (\Exception) {
            return Redirect::back()->with('error', 'Error!! Failed to delete user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        abort_unless(Gate::allows('hasPermission', 'restore_users'), 403);

        try {
            $user = User::withTrashed()->find($id);
            if ($user->restore()) {
                History::create([
                    'description' => 'Restored user with user id ' . $id,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
                return Redirect::back()->with('success', 'Success!! User Restored');
            }
        } catch (\Exception) {
            return Redirect::back()->with('error', 'Error!! Failed to restore user');
        }
    }

    public function getDistricts($stateId)
    {
        $districts = District::where('state_id', $stateId)->get();
        return response()->json($districts);
    }


    public function editProfile($id)
    {
        // $user = Auth::user();

        $role = UtilityFunctions::getRole();

        $user = User::with('roles')->whereIn('id', [$id])->first();

        $districts = District::all();
        $states = State::all();

        return view('admin.profile.edit', [
            'role' => $role,
            'user' => $user,
            'districts' => $districts,
            'states' => $states
        ]);
    }

    // public function updateProfile(Request $request)
    // {
    //     try {

    //         $user = User::find($request->id);

    //         $this->validate($request, [
    //             'name' => 'required',
    //             'email' => 'required',
    //             'role' => 'required',
    //             'is_active' => 'required',
    //             'state_id' => 'nullable',
    //             'district_id' => 'nullable',
    //             'password' => 'required'
    //         ]);

    //         $user->name = $request['name'];
    //         $user->email = $request['email'];
    //         $user->mobile_no = $request['mobile_no'];
    //         $user->office = $request['office'];
    //         $user->role = $request['role'];
    //         $user->password = Hash::make($request['password']);
    //         $user->is_active = $request['is_active'];
    //         $user->district_id = $request['district_id'];
    //         $user->state_id = $request['state_id'];

    //         // dd($user);
    //         if ($user->update()) {

    //             History::create([
    //                 'description' => 'Update user with user id ' . $request['id'],
    //                 'user_id' => Auth::user()->id,
    //                 'type' => 1,
    //                 'ip_address' => UtilityFunctions::getUserIP(),
    //             ]);

    //             return redirect()->route('admin.index')->with('success', 'Success!! User Password Updated');
    //         }
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Error!! User Information Not Updated');
    //     }
    // }

    public function updateProfile(Request $request)
{
    try {
        $user = User::find($request->id);

        $this->validate($request, [
            'password' => 'required',
        ]);

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            History::create([
                'description' => 'Update user password with user id ' . $request->id,
                'user_id' => Auth::user()->id,
                'type' => 1,
                'ip_address' => UtilityFunctions::getUserIP(),
            ]);

            return redirect()->route('admin.index')->with('success', 'तपाईको पासवर्ड परिवर्तन भएको छ');
        }
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'माफ गर्नुहाेला हजुरको Password मिलेन।');
    }
}


}
