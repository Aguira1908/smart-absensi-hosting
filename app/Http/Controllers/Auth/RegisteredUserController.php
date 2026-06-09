<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
     */
    public function store(Request $request): RedirectResponse
    {
        // 🔥 VALIDASI
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:siswa,orang_tua'], // 🔥 role wajib
        ]);

        $role = $request->role;
        $siswa = null;

        // 🔥 JIKA ORANG TUA → WAJIB NIS
        if ($role === 'orang_tua') {
            $request->validate([
                'nis' => ['required']
            ]);

            $siswa = Siswa::where('nis', $request->nis)->first();

            if (!$siswa) {
                throw ValidationException::withMessages([
                    'nis' => 'NIS tidak ditemukan'
                ]);
            }
        }

        // 🔥 SIMPAN USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role, // 🔥 penting
        ]);

        // 🔥 SIMPAN RELASI ORANG TUA - SISWA
        if ($role === 'orang_tua') {
            DB::table('parent_student')->insert([
                'user_id' => $user->id,
                'siswa_id' => $siswa->id
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}