<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    //

    public function getContacts (){
        $contact = Contact::all();
        return response()->json($contact, 200);
    }

    public function saveContact(Request $request){
        $contact = new Contact;

        $contact->name = $request->name;
        $contact->bio = $request->bio;
        $contact->contact_no = $request->contact_no;
        $contact->designation = $request->designation;

        if($contact->save()) {
            return response()->json(['status' => true, 'message' => 'Success', 'data' => $contact]);
        }else{
            return response()->json(['status' => false, 'message' => 'Error']);
        }

    }

    public function deleteContact($id){
        $contact = Contact::find($id);
        if($contact->delete()){
            return response()->json(['status' => true, 'message' => 'Deleted']);
        }else{
            return response()->json(['status' => false, 'message' => 'Error']);
        }
    }

    public function updateContact(Request $request, $id){
        $contact = Contact::where('id', $id)->first();

        $contact->name = $request->name;
        $contact->bio = $request->bio;
        $contact->contact_no = $request->contact_no;
        $contact->designation = $request->designation;

        if($contact->save()) {
            return response()->json(['status' => true, 'message' => 'Update Success']);
        }else{
            return response()->json(['status' => false, 'message' => 'Error']);
        }

    }
}
