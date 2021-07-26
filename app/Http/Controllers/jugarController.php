<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;

class jugarController extends Controller
{
  public function get_questions()
  {
    $dataQuestions = \App\Models\Questions::first();
    $dataAnswer =  \App\Models\Answers::where('ID_Question','=',$dataQuestions->ID_Question)->get();
    $dataQuestions['Answer'] = $dataAnswer;
    return response()->json($dataQuestions, 200);
  }
  public function update_score(request $request)
  {
    $data = $request->all();
    $data_user = \App\Models\UserGroupGames::where('username','=',"tester02")->update(['score' => $data['score']]);;
    return response()->json(['status'=>'completed'], 200);
  }
  public function get_ranking(){
    $data_user = \App\Models\UserGroupGames::orderBy('created_at')->get();;
  }
}