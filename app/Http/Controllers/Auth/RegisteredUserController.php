<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CreateAcountByEmailMailable;
use App\Models\Player;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $status = false;
        $player = Player::where('email', $request->email)->first();
        if($player){
            $password = Str::random(8);
            $mail = new CreateAcountByEmailMailable($password);
            $status = Mail::to($player->email)->send($mail);

            $newUser = User::create([
                'name' => $player->name,
                'email' => $player->email,
                'role' => 'player',
                'password' => Hash::make($password),
                'image' => 'no_photo.png',
            ]);

            $player->user_id = $newUser->id;
            $player->save();
        }

        return redirect('/');
    }
}
