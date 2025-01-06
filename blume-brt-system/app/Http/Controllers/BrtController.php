<?php

namespace App\Http\Controllers;

use App\Models\Brt;
use Illuminate\Http\Request;
use App\Events\BRTUpdated;

class BrtController extends Controller
{
    /**
     * Store a new BRT.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brt_code' => 'required|string|unique:brts',
            'reserved_amount' => 'required|numeric',
            'status' => 'required|string|in:active,expired',
        ]);

        $brt = $request->user()->brts()->create([
            'brt_code' => $request->brt_code,
            'reserved_amount' => $request->reserved_amount,
            'status' => $request->status,
        ]);

        // Trigger event after creating a new BRT
        event(new BRTUpdated($brt));

        return response()->json(['message' => 'BRT created successfully', 'brt' => $brt], 201);
    }

    /**
     * Get all BRTs for the authenticated user.
     */
    public function index(Request $request)
    {
        $brts = $request->user()->brts;
        return response()->json($brts, 200);
    }

    /**
     * Get a specific BRT by ID.
     */
    public function show($id)
    {
        $brt = Brt::where('id', $id)
                  ->where('user_id', auth()->id())
                  ->firstOrFail();

        return response()->json($brt, 200);
    }

    /**
     * Update a specific BRT.
     */
    public function update(Request $request, $id)
    {
        $brt = Brt::where('id', $id)
                  ->where('user_id', auth()->id())
                  ->firstOrFail();

        $request->validate([
            'brt_code' => 'string|unique:brts,brt_code,' . $brt->id,
            'reserved_amount' => 'numeric',
            'status' => 'string|in:active,expired',
        ]);

        $brt->update($request->all());

        // Trigger event after updating a BRT
        event(new BRTUpdated($brt));

        return response()->json(['message' => 'BRT updated successfully', 'brt' => $brt], 200);
    }

    /**
     * Delete a specific BRT.
     */
    public function destroy($id)
    {
        $brt = Brt::where('id', $id)
                  ->where('user_id', auth()->id())
                  ->firstOrFail();

        $brt->delete();

        // Trigger event after deleting a BRT
        event(new BRTUpdated(null));

        return response()->json(['message' => 'BRT deleted successfully'], 200);
    }
}
