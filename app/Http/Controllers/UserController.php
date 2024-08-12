<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Auth;
use App\Http\Resources\UserResource as UserResource;


class UserController extends Controller
{


    public function __construct()
    {

    //    $this->middleware(['role:super_admin']);

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
       return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

    }
       public function index()
       {
        $u = Auth::user();
        $users = User::where('id','!=',$u->id)->get();
         return view('users.index',compact('users'));

       }

       public function edit (User $user )

       {
            return view('users.edit',compact('user'));
       }

       public function update (Request $request ,User $user )

       {

            $request->validate
            ([
                'name' => 'required',
                'roles' => 'required|array|min:1'
            ]);

            $requestData = $request->except('email');
            $user->update($requestData);
            $user->syncRoles($request->roles);

            return redirect()->route('users.index');


       }

       public function destroy($id)
       {

        $x = User::find($id);
        $x->delete();

           return redirect()->route('users.index');
       }
       public function show(User $user)
       {

           return view('users.index');
       }
       public function showProfile($id)
       {
           $user = User::find($id);
           $thisUser = Auth::user();
           if($user->id==$thisUser->id)
           {
            return view('users.profile')->with('user', $user);
           }
           else
           {
            return redirect()->back();
           }

       }
       public function UpdateProfile(Request $request, $id)
       {
        $user = User::find($id);
        $request->validate
        ([
            'name' => 'required',
        ]);

        if($request->has('image'))
        {
       $image = $request->image;
       $newImage = time().$image->getClientOriginalName();
       $image->move('uploads/profile',$newImage);
        $user->image =  'uploads/profile/'.$newImage ;
        }

        $user->name = $request->name;
        $user->save();
        return redirect()->route('profile',$user->id);
       }
       public function DeleteImage ($id)
       {
            $user = User::find($id);
            $thisUser = Auth::user();
           if($user->id==$thisUser->id)
           {
            File::delete($user->image);
            $user->image = NULL;
            $user->save();
            return redirect()->route('profile',$user->id);
           }


       }
       public function info(Request $request )
       {
        $data = $request->user();
        return $this->sendResponse(UserResource::collection($data), 'user retrieved successfully.');

       }



}

