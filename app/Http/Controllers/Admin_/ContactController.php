<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::get(); 
        $pageTitle = 'Contact Messages';
        return view('admin.contact.index', compact('contacts', 'pageTitle'));
    }

  // search by name or email
    public function search(Request $request)
    {
        $search = $request->input('search');
        $contacts = Contact::where('name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orderBy('id', 'desc')
        ->paginate(10);
        $pageTitle = 'Contact Messages';
        return view('admin.contact.index', compact('contacts', 'pageTitle'));
    }

    public function delete($id){
        Contact::find($id)->delete();            
        return redirect()->back()->with('success', 'Contact deleted successfully');  
    }
}