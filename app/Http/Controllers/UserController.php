<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Category;
use App\General_Settings;
use App\Message;
use App\Http\Requests;
use Storage;

class UserController extends Controller
{
    public function getUser()
    {
      $categories = Category::all();
      $website = General_Settings::where('id',1)->first();
      return view('user.user',compact(['categories','website']));
    }

    public function postSignUp(Request $request)
    {

      $email = User::where('email',$request['email'])->count();
      if($email > 0)
      {
        notify()->flash('your email is already registered in the website','error');
        return redirect()->back();
      }

      $this->validate($request,[
          'username' => 'required|min:5',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:8'
      ]);

      $user = new User();
      $user->username = $request['username'];
      $user->email = $request['email'];
      $user->password = bcrypt($request['password']);
      $user->avatar = 'default.png';
      $user->save();
      Auth::login($user);

      $message = Message::where('id',1)->first();
      notify()->flash($message->welcoming_msg,'success',['timer' => 2000]);
      return redirect()->back();
    }

    public function PostSignIn(Request $request)
    {
      $this->validate($request,[
          'email' => 'required|email',
          'password' => 'required'
      ]);

      if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
        $message = Message::where('id',1)->first();
        notify()->flash($message->welcoming_msg,'success',['timer' => 2000]);
        return redirect()->back();
      }
      else {
        notify()->flash('checkout your email or your password is correct','error');
        return redirect()->back();
      }

    }

    public function postChangeGeneralInfo(Request $request)
    {
      $user   = User::where('id',Auth::user()->id)->first();

      if($request['email'] == $user->email)
      {
        $this->validate($request,[
          'avatar' => 'image',
          'username' => 'required|min:5',
          'email' => 'required|email'
        ]);
      }
      else
      {
        $this->validate($request,[
          'avatar' => 'image',
          'username' => 'required|min:5',
          'email' => 'required|email|unique:users'
        ]);
      }
      $user->username = $request['username'];
      $user->email = $request['email'];

      if($request->hasFile('avatar')){
        $oldAvatar = $user->avatar;
        $avatar = $user->id.'.'.$request->file('avatar')->getClientOriginalExtension();
        $request->file('avatar')->move(public_path().'/uploads/avatars/',$avatar);
        $user->avatar = $avatar;
        if($oldAvatar != 'default.png')
          Storage::delete('avatars/'.$oldAvatar);
      }
      $user->update();

      notify()->flash('you have updated your account','success',['timer' => 2000]);
      return redirect()->back();
    }

    public function postChangePassword(Request $request)
    {
      $user = User::where('id',Auth::user()->id)->first();

        $this->validate($request,[
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);

      if(Hash::check($request['old_password'],$user->password)){
        $user->password = bcrypt($request['password']);
        $user->update();
        notify()->flash('you have changed your password successfully','success',['timer' => 2000]);
        return redirect()->back();
      }
      return redirect()->back()->withErrors('your current password is wrong');
    }

    public function getLogout()
    {
      Auth::logout();
      notify()->flash('you logged out','success',['timer' => 2000]);
      return redirect()->back();
    }
}
