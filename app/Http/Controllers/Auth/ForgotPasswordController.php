<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    /**
     * Load view for reset password for talent.
     *
     *
     */
    public function resetPasswordView()
    {
        return view('frontend.resetpassword.password');
    }


    /**
     * Send link to talent
     *
     * @param array
     */
    public function sendLink(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make(
            $input,
            [
                'email' =>  'required|exists:users,email',
            ],
            [
                'email.exists' => 'We can not find a user with that e-mail address',
                'email.required' => 'Please let us know your email',
            ]
        );
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        $user = User::where(array('email' => $input['email']))->first();
        $token = md5(str_shuffle('123456'));
        $data['remember_token'] = $token;
        $data['password_validate_time'] = Carbon::now();
        $user->update($data);
        //$common->sendResetTalentPasswordLink($talent->email, $talent->first_name, $talent->last_name, $token);
        return redirect()->back()->with('message', 'Please check your email to change the password');
    }


    /**
     * Verify link
     *
     * @param array
     */
    public function passwordVerifyLink(Request $request)
    {
        $inputs = $request->all();
        $validation = Validator::make(
            $inputs,
            [
                'token' =>  'exists:talents,remember_token',
            ],
            [
                'token.exists' => 'This Link is expired.',
            ]
        );
        if ($validation->fails()) {
            return redirect()->route('talent.resetPasswordView')->with('error', 'This Link is expired.');
        }
        $token = $inputs['token'];

        return view('frontend.resetPassword.newPassword', ['token' => $token]);
    }


    /**
     * Reset Password final step .
     *
     * @param array
     */
    public function resetPasswordFinalStep(Request $request)
    {
        $inputs = $request->all();
        $validation = Validator::make(
            $inputs,
            [
                'token' =>  'exists:talents,remember_token',
                'password' => 'required|',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'token.exists' => 'Token is not valid.',
            ]
        );
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors()); //->back()->withErrors($validation->errors());
        }
        $talent = TalentModel::where(array('remember_token' => $inputs['token']))->first();
        $now = Carbon::now();
        $from =  $talent->password_validate_time;
        $diff_in_minutes = $now->diffInMinutes($from);
        if ($diff_in_minutes > 10) {
            return redirect()->back()->with('error', 'This link is expired');
        }
        $data['password'] = bcrypt($inputs['password']);
        $data['remember_token'] = $data['password_validate_time'] = NULL;
        if ($talent->update($data)) {
            return redirect()->route('talent.loginView')->with('message', 'Your password is successfully changed.');
        }
    }
}
