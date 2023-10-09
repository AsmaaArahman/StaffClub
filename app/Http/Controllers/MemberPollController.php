<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberPollController extends Controller
{
        public function index() {
                $active_polls= \App\Models\Poll::where("active", "=" , "1")->get();
                return view("memberPoll")->with(["active_polls"=>$active_polls]);
        }

        

        public function takePoll($id) {
                $poll= \App\Models\Poll::find($id);
                
                return view("takePoll")->with(["poll" => $poll]);
        }


        public function saveAnswers(){
                //TODO(walid): perform checks and validations;
                $answers=[];
                $member= session()->get("user");

                $validator = Validator::make(
                        request()->all(),
                        [
                                "answers"=>"required|array"
                        ]
                );

                if($validator->fails()) {
                        return "error";
                }
                $poll= \App\Models\Poll::find(request()->get("poll_id"));

                if(memberAllowedToVote($member, $poll) == false) {
                        return "error, you can't take the poll twice";
                }
                
                foreach(request()->get("answers") as $question => $answer) {
                        $a= new \App\Models\Answer();
                        $a->option()->associate(\App\Models\Option::find($answer)) ;
                        $a->member()->associate($member) ;
                        $a->question()->associate(\App\Models\Question::find($question));
                        $a->save();
                } 


                $poll_voter= new \App\Models\PollVoters();
                $poll_voter->member_id= $member->id;
                $poll_voter->poll_id= $poll->id;

                if($poll_voter->save()) {
                        return "success";

                } else {
                        return "error";
                } 
                
                        
        }

        
}
