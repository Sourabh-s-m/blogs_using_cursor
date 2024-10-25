<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withCount('blogs')->where('role', '!=', 'admin')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData);

            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);

            $user->update($validatedData);

            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Prevent self-deletion
            if ($user->id === auth()->id()) {
                throw new \Exception('You cannot delete your own account.');
            }

            // Begin transaction
            \DB::beginTransaction();

            // Delete associated blogs first
            $blogsCount = $user->blogs()->count();
            $user->blogs()->delete();

            // Then delete the user
            $user->delete();

            // Commit transaction
            \DB::commit();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "User and their {$blogsCount} blog(s) deleted successfully!"
                ]);
            }

            return redirect()->route('users.index')
                ->with('success', "User and their {$blogsCount} blog(s) deleted successfully!");
        } catch (\Exception $e) {
            // Rollback transaction on error
            \DB::rollBack();

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
