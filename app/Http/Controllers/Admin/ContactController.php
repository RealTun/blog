<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index(){
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function delete(string $id){
        $contacte = Contact::find($id);
        $contacte->delete();    
        return redirect()->route('admin.contacts.index')->with('success','Delete contact successful');
    }
}
