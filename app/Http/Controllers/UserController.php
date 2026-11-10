<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display all users whose role is admin.
     */
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'super_admin'])->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display all users whose role are customer.
     */
    public function customers()
    {
        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->withSum('orders', 'total')
            ->latest()
            ->get();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => 'required|string|min:8|confirmed',

            'phone' => 'nullable|string|max:20',

            'role' => [
                'required',
                Rule::in(['admin', 'customer']),
            ],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display a specific user.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Display a specific user whose role are customer.
     */
    public function showCustomer(User $user)
    {
        $user->load('orders');

        $totalOrders = $user->orders->count();

        $totalSpent = $user->orders->sum('total');

        $averageOrderValue = $totalOrders > 0
            ? $totalSpent / $totalOrders
            : 0;

        return view('admin.customers.show', compact(
            'user',
            'totalOrders',
            'totalSpent',
            'averageOrderValue'
        ));
    }

    /**
     * Show the form for editing a user.
     */
    public function edit(User $user)
    {
        if (Auth::user()->role !== 'super_admin' && Auth::id() !== $user->id) {
            return back()->with('warning', 'You can only edit your own account.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update an existing user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'password' => 'nullable|string|min:8|confirmed',

            'phone' => 'nullable|string|max:20',

            'role' => [
                'required',
                Rule::in(['admin', 'customer']),
            ],
            'status' => 'string',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        if (
            in_array($user->role, ['admin', 'super_admin']) &&
            Auth::user()->role !== 'super_admin' &&
            Auth::id() !== $user->id
        ) {
            return back()->with('error', 'You are not authorized to delete this user account.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    public function updateAccountDetails(Request $request)
    {
        $user = auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with(
            'success',
            'Your account details have been updated successfully!'
        );
    }
}
