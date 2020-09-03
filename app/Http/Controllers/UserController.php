<?php

namespace App\Http\Controllers;

use App\Profile;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function profile() {
        return view('profile.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }
    public function profilestore(Request $request) {
        $this->validate($request,[
            'address'=>'required',
            'phone_number'=>'required|min:10|numeric',
        ]);
        $user_id = auth()->user()->id;
        Profile::where('user_id', $user_id)->update([
            'address'=>request('address'),
            'phone_number'=>request('phone_number'),
            'experience'=>request('experience'),
            'bio'=>request('bio'),
        ]);
        return redirect()->back()->with('message','Profile Successfully Updated!');
    }

    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $user = User::findOrFail($id);
        $user->update($requestData);

        $user->syncRoles($request->roles);

        return redirect('admin/user')->with('flash_message', 'User updated!');
    }
    public function coverletter(Request $request) {
        $this->validate($request,[
            'cover_letter'=>'required|mimes:pdf,doc,docx|max:20000'
        ]);
        $user_id = auth()->user()->id;
        $cover = $request->file('cover_letter')->store('public/files/');
        Profile::where('user_id', $user_id)->update([
            'cover_letter'=>$cover
        ]);
        return redirect()->back()->with('message','Cover Successfully Updated!');
    }

    public function identification(Request $request) {
        $this->validate($request,[
            'identification'=>'required'
        ]);
        $user_id = auth()->user()->id;
        $identification = $request->file('identification')->store('public/files/');
        Profile::where('user_id', $user_id)->update([
            'identification'=>$identification
        ]);
        return redirect()->back()->with('message','Identification Successfully Updated!');
    }

    public function avatar(Request $request) {
        $this->validate($request,[
            'avatar'=>'required|mimes:png,jpeg,jpg,gif|max:20000'
        ]);
        $user_id = auth()->user()->id;
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/avatar/', $filename);
            Profile::where('user_id', $user_id)->update([
                'avatar'=>$filename
            ]);
            return redirect()->back()->with('message','Profile Successfully Updated!');
        }
    }
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('admin/user')->with('flash_message', 'User deleted!');
    }

//    I could just destroy the User ID like the above method but Id like to just deactivate their account
    public function close(Request $request) {
        $user_id = auth()->user()->id;
        User::where('id', $user_id)->update([
            'active'=>request('active'),
        ]);

        Auth::logout();
        return redirect('home')->with('flash_message', 'You have successfully closed your account!');
    }

}
