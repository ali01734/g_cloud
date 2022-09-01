<?php

namespace nataalam\Http\Controllers;

use Auth;
use File;
use Intervention\Image\Facades\Image;
use nataalam\Http\Requests;
use nataalam\Http\Requests\MailConfirmRequest;
use nataalam\Http\Requests\ResendConfirmationMailRequest;
use nataalam\Http\Requests\UpdatePasswordRequest;
use nataalam\Http\Requests\UpdateUserRequest;
use nataalam\Mail\AddressConfirmationMail;
use nataalam\Models\City;
use nataalam\Models\Level;
use nataalam\Models\User;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UserController extends Controller
{
    public function showInFrontend(User $user)
    {
        $levels = Level::all();
        $cities = City::all();
        $photoExists = File::exists(
            storage_path(User::$photoPath . "/$user->id.jpg")
        );

        return view(
            'client.users.show',
            compact('user', 'levels', 'cities', 'photoExists')
        );
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->all());

        $user->level_id = $request->get('level') ?: null;
        $user->city_id = $request->get('city') ?: null;
        $user->branch_id = $request->get('branch') ?: null;

        $user->save();

        return redirect()->back();
    }

    public function updatePhoto(User $user, Requests\UpdateUserPhotoRequest $request) {
        try {
            $file = $request->file('photo');

            $image = Image::make($file->getPathname());
            $image->fit(150, 150);
            $image->save(storage_path(User::$photoPath) . "/$user->id.jpg");

            $request
                ->session()
                ->flash('success', trans('strings.photoChanged'));

        } catch (FileException $e) {
            $request
                ->session()
                ->flash('error', 'fileUploadError');
        }

        return redirect()->back();

    }

    public function settings(User $user) {
        return view('client.users.settings', compact('user'));
    }

    public function updatePassword(User $user, UpdatePasswordRequest $request) {
        $user->password = \Hash::make($request->get('new_password'));
        $user->save();

        return redirect()->back();
    }

    public function confirmMailAddress(User $user, MailConfirmRequest $req) {
        $user->verified = true;
        $user->save();
        $req->session()->flash('success', trans('strings.mailConfirmed'));

        return redirect()->route('client_index');
    }

    public function showNotConfirmedMailErrorPage()
    {
        return view('errors.confirm-mail');
    }

    public function resendConfirmationMail(ResendConfirmationMailRequest $req)
    {
        if (Auth::user()->verified) {
            $req
                ->session()
                ->flash('success', trans('strings.alreadyConfirmed'));
            return redirect('/');

        } else {
            $mail = new AddressConfirmationMail(Auth::user());
            $mail->send();

            $req
                ->session()
                ->flash('success', trans('strings.confirmSent'));
            return redirect()->back();
        }
    }
}
