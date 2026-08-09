<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function editPost(Request $request)
    {

        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'mobile_no' => ['nullable', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'profile_photo' => ['nullable'],
        ]);
        $user = auth()->user();
        if ($request->file('profile_photo')) {
            if (file_exists($user->profile_photo)) {
                unlink($user->profile_photo);
            }
            // Upload Image
            $file = $request->file('profile_photo');
            $filename = Uuid::uuid1()->toString() . '.' . $file->extension();
            $destinationPath = 'uploads/user/profile_photo';
            $file->move($destinationPath, $filename);
            $path = 'uploads/user/profile_photo/' . $filename;

            $user->profile_photo = $path;
        }

        $user->name = $request->name;
        $user->mobile_no = $request->mobile_no;
        $user->updated_by = auth()->id();
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
