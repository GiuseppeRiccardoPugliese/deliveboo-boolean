<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $data = $request->all();
    
        // Verifica se è stata fornita un'immagine
        if ($request->hasFile('image')) {
            // Carica l'immagine solo se è stata fornita
            $img = $request->file('image');
            $img_path = Storage::disk('public')->put('images', $img);
    
            // Assegna il percorso dell'immagine al campo 'image' del ristorante
            $data['image'] = $img_path;
        }
    
        $restaurant = new Restaurant();
        $restaurant->name = $data['restaurant_name'];
        $restaurant->piva = $data['piva'];
        $restaurant->image = $data['image'] ?? null; // Assegna null se non è stata fornita un'immagine
        $restaurant->address = $data['restaurant_address'];
        // $restaurant->visible = isset($data['visible']) ? true : false;
    
        $restaurant->user()->associate($user);
    
        $restaurant->save();
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }
    
}
