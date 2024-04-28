<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contacts\ContactStoreRequest;
use App\Http\Resources\AccountsCollection;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactsCollection;
use App\Models\Account;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = new ContactsCollection(Contact::query()->get());

        return Inertia::render('Contacts/Index', [
            'contacts' => $contacts
        ]);
    }

    public function show(Contact $contact)
    {
        $contact = new ContactResource($contact);

        return Inertia::render('Contacts/Show', [
            'contact' => $contact
        ]);
    }

    public function create()
    {
        $accounts = new AccountsCollection(Account::query()->get());

        return Inertia::render('Contacts/Create', [
            'accounts' => $accounts
        ]);
    }

    public function store(ContactStoreRequest $request)
    {
        $data = $request->validated();

        $contact = new Contact();
        $contact->first_name = $data['first_name'];
        $contact->last_name = $data['last_name'];
        $contact->email = $data['email'];
        $contact->phone = $data['phone'];
        $contact->position = $data['position'];
        $contact->account_id = $data['account']['id'];

        if($contact->save()) {
            return redirect()->route('contacts.index');
        }
    }

    public function edit(Contact $contact)
    {
        $contact = new ContactResource($contact);
        $accounts = new AccountsCollection(Account::query()->get());

        return Inertia::render('Contacts/Edit', [
            'contact' => $contact,
            'accounts' => $accounts,
        ]);
    }

    public function update(ContactStoreRequest $request, Contact $contact)
    {
        $data = $request->validated();

        $contact->first_name = $data['first_name'];
        $contact->last_name = $data['last_name'];
        $contact->email = $data['email'];
        $contact->phone = $data['phone'];
        $contact->position = $data['position'];
        $contact->account_id = $data['account']['id'];

        if($contact->save()) {
            return redirect()->route('contacts.index');
        }
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index');

    }
}
