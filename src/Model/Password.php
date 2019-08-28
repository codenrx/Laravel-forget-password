<?php

namespace codenrx\forgetpassword\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Mail;
use Session;
use codenrx\forgetpassword\Mail\forgetPassword;

class Password extends Model
{
    protected $table = 'passwords';
    protected $fillable = ['email', 'token', 'status'];

    protected function send($email)
    {
        $user = User::where('email', $email)->first();
        if ($user == null) {
            return "failed";
        } else {
            $token = Session::token();
            $password = Password::create(['email' => $email, 'token' => $token]);
            Mail::to($email)->send(new forgetPassword($token));
            return "sucess";
        }
    }

    protected function check($token)
    {
        $check = Password::where('token', $token)->first();
        if ($check == null) {
            return "failed";
        }
    }

    protected function updatePassword($password, $token)
    {
        $check = Password::where('token', $token)->first();
        if ($check == null) {
            return "failed";
        } else {
            $newPass = bcrypt($password);
            User::where('email', $check->email)->update(['password' => $newPass]);
            $check->delete();
            return "sucess";
        }
    }
}
