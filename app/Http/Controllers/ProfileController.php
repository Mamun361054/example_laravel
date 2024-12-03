<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $data = [];
        if ($request->edit) {
            $user = User::find($request->id);
            if ($user) {
                $data['editUser'] = $user;
            }
        }
        $data['user-list'] = User::get();
        return view('profile.show', compact('data'));
    }

    public function delete(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
            }
            return redirect('/');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {

        try {

            $validated = $request->validate([
                'email' => 'required|unique:users|max:255',
                'password' => 'required',
                'name' => 'required',
            ]);

            $password = Hash::make($request->password);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
            ]);

            return redirect('/');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'email' => 'required|email',
                'name' => 'required|string|max:255',
            ]);

            // Find the record by ID
            $user = User::findOrFail($id);

            // Update the record
            $user->email = $validated['email'];
            $user->name = $validated['name'];

            // Save the changes
            $user->save();

            return redirect('/');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation error messages
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $th) {
            // Handle other exceptions
            return response()->json([
                'message' => 'An error occurred',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

}
