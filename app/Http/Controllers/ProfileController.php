<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;



class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = User::find(Auth::user()->id);
        $permissions = $user->permissions;
        $filename = $user->photo;
        return view('profile.edit', compact('user', 'permissions', 'filename'));
    }


    public function update(ProfileRequest $request)
    {
        $user = User::find($request->id);
        $filename = Auth::user()->photo;

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tb_users,email,' . $request->id,
            'cpf' => 'required|string|unique:tb_users,cpf,' . $request->id,
            'birth_date' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'responsible' => 'nullable|string|max:255',
            'kinship_level' => 'nullable|string|max:255',
            'terms' => 'required|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->store('public/photos');
            $filename = str_replace('public/', '', $path);
        }

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'cpf' => $validatedData['cpf'],
            'birth_date' => $validatedData['birth_date'],
            'phone' => $validatedData['phone'],
            'nationality' => $validatedData['nationality'],
            'photo' => $filename,
            'responsible' => $validatedData['responsible'],
            'kinship_level' => $validatedData['kinship_level'],
            'terms' => $validatedData['terms'],
        ]);

        return back()->withStatus(__('Usuário atualizado com sucesso!'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        Auth::user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
