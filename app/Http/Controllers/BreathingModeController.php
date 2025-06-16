<?php

namespace App\Http\Controllers;
use App\Models\BreathingMode;
use Illuminate\Http\Request;

class BreathingModeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('breathing-modes.index', [
            'breathingModes' => BreathingMode::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createSession(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non authentifié'], 401);
        }

        // Appeler la méthode pour créer une session
        $stats = $user->createCoherenceCardiaqueSession();

        return response()->json([
            'message' => 'Session créée avec succès',
            'data' => $stats,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBreathingModeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BreathingMode $breathingMode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BreathingMode $breathingMode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBreathingModeRequest $request, BreathingMode $breathingMode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BreathingMode $breathingMode)
    {
        //
    }
}
