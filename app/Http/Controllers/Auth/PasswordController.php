<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
 public function changePassword(Request $request){
    $request->validate([
        'oldPassword' => 'required',
        'newPassword' => 'required|min:6',
        'confirmPassword' => 'required|same:newPassword',
    ]);

    $user = Auth::user();
    $dbHashPassword = $user->password;

    if (Hash::check($request->oldPassword, $dbHashPassword)) {
        // Mise à jour du mot de passe
        $user->update([
            'password' => Hash::make($request->newPassword)
        ]);


        return back();
    } else {
        return back()->withErrors(['oldPassword' => 'The current password is incorrect.']);
    }
}

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
