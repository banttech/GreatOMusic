<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqsController extends Controller
{
    public function index(){
        $pageTitle = "Manage Faqs";
        $faqs = Faq::paginate(10);
        return view('admin.faqs.index',compact('pageTitle','faqs'));
    }

    public function search(Request $request){
        $pageTitle = "Manage Faqs";
        $search = $request->search;
        $faqs = Faq::where('question','like','%'.$search.'%')->paginate(10);
        return view('admin.faqs.index',compact('pageTitle','faqs','search'));
    }

    public function create(){
        $pageTitle = "Create Faq";
        return view('admin.faqs.create',compact('pageTitle'));
    }

    public function store(Request $request){
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ],[
            'question.required' => 'Question field is required!',
            'answer.required' => 'Answer field is required!',
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('faqs')->with('success','Faq created successfully!');
    }

    public function edit($id){
        $pageTitle = "Edit Faq";
        $faq = Faq::find($id);
        return view('admin.faqs.edit',compact('pageTitle','faq'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ],[
            'question.required' => 'Question field is required!',
            'answer.required' => 'Answer field is required!',
        ]);

        $faq = Faq::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('faqs')->with('success','Faq updated successfully!');
    }

    public function delete($id){
        $faq = Faq::find($id);
        $faq->delete();
        return redirect()->route('faqs')->with('success','Faq deleted successfully!');
    }
}