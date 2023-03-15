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

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->store('public/photos');
            $filename = str_replace('public/', '', $path);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'nationality' => $request->nationality,
            'photo' => $filename,
            'responsible' => $request->responsible,
            'kinship_level' => $request->kinship_level,
            'terms' => $request->terms,
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
