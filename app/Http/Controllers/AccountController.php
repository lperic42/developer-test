<?php

namespace App\Http\Controllers;


use App\Http\Resources\AccountResource;
use App\Http\Resources\AccountsCollection;
use App\Http\Resources\UsersCollection;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = new AccountsCollection(Account::query()->get());

        return Inertia::render('Accounts/Index', [
            'accounts' => $accounts
        ]);
    }

    public function show(Account $account)
    {
        $account = new AccountResource($account);

        return Inertia::render('Accounts/Show', [
            'account' => $account,
        ]);
    }

    public function create()
    {
        $users = new UsersCollection(User::query()->get());

        return Inertia::render('Accounts/Create', [
            'users' => $users
        ]);
    }

    public function store()
    {

    }

    public function edit(Account $account)
    {
        $account = new AccountResource($account);
        $users = new UsersCollection(User::query()->get());

        return Inertia::render('Accounts/Edit', [
            'account' => $account,
            'users' => $users
        ]);
    }

    public function update()
    {

    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index');
    }
}
