<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HasApiTokens;

    // Inscription (Signup)
    public function signup(SignupRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $token = $user->createToken('main')->plainTextToken;

        // Retourner l'utilisateur et le token
        return response(compact('user', 'token'));
    }

    // Connexion (Login)
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Adresse email ou mot de passe incorrect.'
            ], 401); // Retourne un code 401 si les informations d'identification sont incorrectes
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        // Retourner l'utilisateur et le token
        return response(compact('user', 'token'));
    }

    // Déconnexion (Logout)
    public function logout(Request $request)
    {
        /** @var User $user */
        $user = $request->user();  // Récupère l'utilisateur authentifié
        $user->currentAccessToken()->delete();  // Supprime le token actuel

        return response('', 204);  // Code 204 signifie succès sans contenu
    }
}
