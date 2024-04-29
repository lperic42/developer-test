<?php

namespace App\Http\Controllers;


use App\Http\Requests\Accounts\AccountStoreRequest;
use App\Http\Resources\AccountResource;
use App\Http\Resources\AccountsCollection;
use App\Http\Resources\ContactsCollection;
use App\Http\Resources\UsersCollection;
use App\Models\Account;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
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

    /*
     * Included the $owner and $contacts variables to pass the tests but handled them differently (using AccountResource)
     **/
    public function show(Account $account)
    {
        $account = new AccountResource($account);
        $owner = $account->owner;
        $contacts = $account->contacts;

        return Inertia::render('Accounts/Show', [
            'account' => $account,
            'owner' => $owner,
            'contacts' => $contacts
        ]);
    }

    public function create()
    {
        $users = new UsersCollection(User::query()->get());

        return Inertia::render('Accounts/Create', [
            'users' => $users
        ]);
    }

    public function store(AccountStoreRequest $request)
    {
        $data = $request->validated();

        $account = new Account();
        $account->name = $data['name'];
        $account->address = $data['address'];
        $account->town_city = $data['town_city'];
        $account->country = $data['country'];
        $account->post_code = $data['post_code'];
        $account->phone = $data['phone'];
        $account->owner_id = $data['owner_id'];

        if($account->save()) {
            return redirect()->route('accounts.index');
        }
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

    public function update(AccountStoreRequest $request, Account $account)
    {
        $data = $request->validated();

        $account->name = $data['name'] ?? $account->name;
        $account->address = $data['address'] ?? $account->address;
        $account->town_city = $data['town_city'] ?? $account->town_city;
        $account->country = $data['country'] ?? $account->country;
        $account->post_code = $data['post_code'] ?? $account->post_code;
        $account->phone = $data['phone'] ?? $account->phone;
        $account->owner_id = $data['owner_id'] ?? $account->owner_id;

        if($account->save()) {
            return redirect()->route('accounts.index');
        }
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index');
    }
}
