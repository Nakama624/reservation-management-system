<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;



class ContactController extends Controller
{
    public function contactList(){
        $user = auth()->user();
        $contacts = Contact::where("user_id", $user->id)
            ->get();

        return view("contact-list", compact("contacts"));
    }

    public function Destroy($contact_id){
        // ステータスによって削除可否を追加
        Contact::find($contact_id)->delete();
        return redirect('/contact/list')->with('message', 'Todoを削除しました');
    }

    public function contactDelete($contact_id){
        $contact = Contact::find($contact_id);

    }

    // 新規問合せ
    public function contact(){
        
        return view("contact");
    }

    public function confirm(ContactRequest $request){
        $contact = $request->only([
            'title',
            'detail',
        ]);
        // 画像を先に保存
        if ($request->hasFile('img')){
            $contact['img'] = $request->file('img')->store('contacts', 'public');
        }
        return view("contact-confirm", compact("contact"));
    }

    public function complete(Request $request){
        $user = auth()->user();

        Contact::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'detail' => $request->detail,
            'img' => $request->img,
        ]);
        return redirect('/contact/list');
    }


}
