<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Notifications\SendTwoFactorCode;



class TwoFactorController extends Controller
{
    public function index(): View
    {
        return view('auth.twoFactor');
    }

public function store(Request $request): ValidationException|RedirectResponse
    {
        $request->validate([
            'two_factor_code' => ['integer', 'required'],
        ]);
        $user = auth()->user();
        if ($request->input('two_factor_code') !== $user->two_factor_code) {
            throw ValidationException::withMessages(['two_factor_code' => __("El codigo no es valido ")]);
        }

        //Resetea el codigo 2FA
        $user->resetTwoFactorCode();
        return redirect()->to('/');
    }
    public function resend(): RedirectResponse
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new SendTwoFactorCode());
        return redirect()->back()->withStatus(__('El código ha sido enviado nuevamente'));
    }
}
