<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function contact(): JsonResponse{

        return response()->json();
    }

    public function contactList(Request $request): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $contacts = Contact::where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($contact) use ($user) {
                return [
                    'id' => $contact->id,
                    'user_id' => $user->id,
                    'title' => $contact->title,
                    'status' => $contact->status,
                    'created_at' => $contact->created_at->format('Y-m-d H:i'),
                ];
            });

        return response()->json($contacts);
    }
    
    public function contactDetail($contact_id): JsonResponse{
        $contact = Contact::findOrFail($contact_id);

        return response()->json($contact);
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
        return response()->json($contact);
    }

    public function complete(Request $request){
        $user = auth()->user();

        Contact::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'detail' => $request->detail,
            'img' => $request->img,
        ]);
        return response()->json([
            'message' => 'お問い合わせを保存しました',
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
