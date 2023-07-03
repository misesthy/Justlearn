<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\StoreUserRequest;
use Exception;
use PhpOption\Option;
use PhpParser\Node\Stmt\Catch_;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(): View
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $users = User::with('roles')->paginate();
        $users = User::with('services')->paginate();
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create(): View
    { 
        $roles = Role::all()->pluck('name', 'id');
        $services = Service::all();
        $user = User::all()->pluck('name', 'id');
        return view('users.create', compact('user','roles','services'));
    }

    public function show($id)
    {
        $user = User::with('services')->find($id);
        
        return view('users.show', compact('user'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        
        $user->assignRole($request->input('role'));

        $services =$request->input('services');
        $input = implode(',',$services);
        $user->services()->sync(explode(',', $input));
        // $services = Service::whereIn('id', $serviceIds)->get();
        // $services = $request->input('services');
        // $user->services()->sync($services);
        
        // try{
        //     $user->save();
        // }catch(Exception $e){
        //     dd('bonjour');
        // }

        return redirect()->route('users.index');
    }

    public function edit($id )
    {
        $services = Service::all();
        $roles = Role::pluck('name', 'id');
        $user = User::with('services')->find($id);
        return view('users.edit', compact('user', 'roles','services'));
    }

    public function update(EditUserRequest $request, User $user)
    {
        if ($request->has('password')) {
            
            $user->update(['password' => bcrypt($request->input('password'))]);
        }
        
        $user->update([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => $request->has('password') ? bcrypt($request->input('password')) : '',
            // 'service' => $request->input('services'),
        ]);

        $user->syncRoles($request->input('role'));
        // $service = Service::find($request->input('service'));
        // $user->services()->sync($service);
        // $user->save();
        $services =$request->input('services');
        $input = implode(',',$services);
        $user->services()->sync(explode(',', $input));

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
