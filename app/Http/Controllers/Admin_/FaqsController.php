<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Validator;

class FaqsController extends Controller
{
    public function index(){
        $pageTitle = "Manage FAQ's";
        $faqs = Faq::all();
        return view('admin.faqs.index',compact('pageTitle','faqs'));
    }

    public function search(Request $request){
        $pageTitle = "Manage FAQ's";
        $search = $request->search;
        $faqs = Faq::where('question','like','%'.$search.'%')->paginate(10);
        return view('admin.faqs.index',compact('pageTitle','faqs','search'));
    }

    public function details($id){
        $pageTitle = "FAQ Detail";
        $faq = Faq::find($id);
        return view('admin.faqs.details',compact('pageTitle','faq'));
    }

    public function create(){
        $pageTitle = "Create FAQ";
        return view('admin.faqs.create',compact('pageTitle'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
        ],[
            'question.required' => 'Question field is required!',
            'answer.required' => 'Answer field is required!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('faqs')->with('success','Faq created successfully!');
    }

    public function edit($id){
        $pageTitle = "Edit FAQ";
        $faq = Faq::find($id);
        return view('admin.faqs.edit',compact('pageTitle','faq'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
        ],[
            'question.required' => 'Question field is required!',
            'answer.required' => 'Answer field is required!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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