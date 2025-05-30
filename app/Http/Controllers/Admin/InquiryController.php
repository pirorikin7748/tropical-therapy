<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryReplyMail;
use Illuminate\Support\Facades\Redis;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        //ステータス（未対応pending,対応済replied)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        //開始日
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        //終了日
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $contacts = $query->orderBy('created_at', 'asc')->paginate(10);

        return view('admin.inquiries.index', compact('contacts'));
    }

    public function showReplyForm($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.inquiries.reply', compact('contact'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->reply_message = $request->reply_message;
        $contact->status = 'replied';
        $contact->replied_at = now();
        $contact->save();

        //メール返信
        Mail::to($contact->email)->send(new InquiryReplyMail($contact));

        return redirect()->route('admin.inquiries.index')->with('success', '返信を送信しました。');
    }
}
