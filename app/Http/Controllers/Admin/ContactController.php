<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::latest();

        if ($request->filter == 'consultation') {
            $query->where('source', 'consultation');
        } elseif ($request->filter == 'contact') {
            $query->where('source', '!=', 'consultation');
        }

        $contacts = $query->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully.');
    }
}
