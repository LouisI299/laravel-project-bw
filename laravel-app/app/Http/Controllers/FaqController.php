<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Show the FAQ page
    public function index()
    {
        $categories = Category::with('faqs')->get();
        return view('faq', compact('categories'));
    }

    // Admin: Show form to create FAQ
    public function create()
    {
        $categories = Category::all();
        return view('admin.faq.create', compact('categories'));
    }

    // Admin: Store new FAQ
    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Faq::create($data);

        return redirect()->route('faq.index')->with('status', 'FAQ created successfully!');
    }

    // Admin: Edit FAQ
    public function edit(Faq $faq)
    {
        $categories = Category::all();
        return view('admin.faq.edit', compact('faq', 'categories'));
    }

    // Admin: Update FAQ
    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $faq->update($data);

        return redirect()->route('faq.index')->with('status', 'FAQ updated successfully!');
    }

    // Admin: Delete FAQ
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faq.index')->with('status', 'FAQ deleted successfully!');
    }
}