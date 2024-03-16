<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Activitylog\LogActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dologin(Request $request)
    {
        $credentials = $request->validate(
            [
                'name' => 'required|string',
                'password' => 'required',
            ],
            [
                'name.required' => 'Username harus diisi',
                'password.required' => 'Password harus diisi'
            ]
        );

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        return back()->with('error', 'Email Atau Password Anda Salah');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgot()
    {
        return view('auth.forgot-password');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forget_mail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Memeriksa apakah email ada dalam tabel pengguna
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email Anda tidak terdaftar.');
        }

        // Jika email ditemukan, kirim tautan reset password
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Cek email Anda untuk merubah password Anda.')
            : back()->with('error', 'Gagal mengirim tautan reset.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reset_password($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request)
    {
        $request->validate(
            [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ],
            [
                'pasword.required' => 'Password harus diisi',
                'pasword.min:8' => 'Password minimal 8 karakter'
            ]

        );

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('dashboard');
    }
}
