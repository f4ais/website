<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->when($request->filled('role'), fn ($q) => $q->where('role', $request->role))
            ->when($request->filled('search'), fn ($q) => $q->where(fn ($sub) => $sub
                ->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')))
            ->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.form', ['user' => new User]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['password'] = $request->validate(['password' => ['required', 'string', 'min:8', 'confirmed']])['password'];
        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $this->validated($request, $user);
        $password = $request->validate(['password' => ['nullable', 'string', 'min:8', 'confirmed']])['password'] ?? null;
        if ($password) $data['password'] = $password;
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if($user->is(auth()->user()), 422, 'Akun sendiri tidak dapat dihapus.');
        abort_if(
            $user->citizens()->exists() || $user->surveys()->exists() || $user->distributions()->exists() || $user->determinedRecipients()->exists(),
            422,
            'Akun sudah memiliki riwayat data. Nonaktifkan akun agar riwayat tetap tersimpan.'
        );
        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus.');
    }

    private function validated(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'role' => ['required', Rule::in(['admin', 'rtrw', 'surveyor', 'penyalur'])],
            'wilayah' => ['nullable', 'required_if:role,rtrw', 'string', 'max:100'],
            'is_active' => ['required', 'boolean'],
        ]);
    }
}
