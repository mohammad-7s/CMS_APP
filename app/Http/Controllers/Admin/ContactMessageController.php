<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{

    public function index(Request $request)
{
    $query = ContactMessage::query();

    // Search by name or email
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    //  Filter by status
    if ($request->status === 'new') {
        $query->where('reviewed', false);
    }

    if ($request->status === 'reviewed') {
        $query->where('reviewed', true);
    }

    $messages = $query->latest()->paginate(10);

    return view('admin.contact.index', compact('messages'));
}

public function markReviewed($id)
{
    $msg = ContactMessage::findOrFail($id);
    $msg->reviewed = true;
    $msg->save();

    return back()->with('success', 'Marked as reviewed');
}

public function destroy($id)
{
    ContactMessage::findOrFail($id)->delete();
    return back()->with('success', 'The message has been successfully deleted');
}

}
