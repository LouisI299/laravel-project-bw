<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ProposedFaq;
use App\Models\Faq;

class ProposedFaqController extends Controller
{
    //
    public function create()
    {
        return view('proposed_faqs.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        ProposedFaq::create([
            'user_id' => $request->user()->id,
            'question' => $validated['question'],
            'details' => $validated['details'],
        ]);

        return redirect()->route('faq.index')->with('success', 'Your question has been submitted for review.');
    }

    
    public function index()
    {
        $proposedFaqs = ProposedFaq::where('status', 'pending')->get();

        return view('admin.proposed_faqs.index', compact('proposedFaqs'));
    }

    
    public function approve($id)
    {
        $proposedFaq = ProposedFaq::findOrFail($id);
        $proposedFaq->update(['status' => 'approved']);

        
        Faq::create(['question' => $proposedFaq->question, 'answer' => 'Pending admin input', 'category_id' => 1]);

        return back()->with('success', 'Question approved.');
    }

    
    public function reject($id)
    {
        $proposedFaq = ProposedFaq::findOrFail($id);
        $proposedFaq->update(['status' => 'rejected']);

        return back()->with('success', 'Question rejected.');
    }
}