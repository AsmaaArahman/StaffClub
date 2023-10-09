<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
        public function index() {
                return view("admin/index");
        }



        public function viewMembers() {
                $members= \App\Models\Member::paginate(10);
                return view("admin/members")->with([
                        "members"=>$members
                ]);
        }



        public function viewSingleMember($id) {
                
                
                $member= \App\Models\Member::find($id);
                $kinships= \App\Models\Kinship::all();
                return view("admin/singleMember")->with([
                        "member" => $member,
                        "kinships"=> $kinships
                ]); 
        }


        public function getEditSingleMember($id) {
                if(!isAllowed(["admin", "normal_mod"])){
                        return back();
                }

                $member= \App\Models\Member::find($id);
                return view("admin/editSingleMember")->with(["member"=>$member]);
        }
        

        
        public function postEditSingleMember($id)
        {
                if(!isAllowed(["admin", "normal_mod"])){
                        return back();
                }
                
                $requestData= request()->all();
                if(request()->has("nat_id")){
                        $requestData["nat_id"]  = fromEasternArabicToWestern($requestData["nat_id"]);
                }
                if(request()->has("password")){
                        $requestData["password"]  = fromEasternArabicToWestern($requestData["password"]);
                }
                request()->replace($requestData);

                
                $member= \App\Models\Member::find($id);

                $validator= Validator::make(request()->all(), [
                        "fullname"=> "required",
                        "nat_id"=>"required|digits:14|unique:members,nat_id,".$member->id,
                        // "phone"=>"required",
                        // "password"=> "required",
                        // "kinship"=>"required",
                        "gender"=> "required",
                        "faculty"=> "required",
                        "status"=>"required",
                        "designation"=>"required",

                ]);

                
                
                if($validator->fails()) {
                        session()->flash("edit-member-errors", ""    );
                        return back() ->withErrors($validator)
                                      ->withInput();
                }


                if(request()->hasFile("pic") && request()->file("pic") != null) {
                        $pic= "";
                        $pic=request()->file("pic");
                        $validator = Validator::make(request()->all(), ["pic"=> "between:0,2048|mimes:jpeg,png,svg,gif"]);
                        if($validator->fails()) {
                                return back() ->withErrors($validator)
                                                            ->withInput();
                        }
                        
                        
                        if($member->pic != null) {
                                deletePicFromDisk($member->pic);
                        }

                        
                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                        $member->pic= $pic;

                }

                       
                $fullname= request()->get("fullname");
                $phone = request()->get("phone");
                $gender = request()->get("gender");
                if(request()->get("designation") != null) {
                        $member->designation = request()->get("designation");
                }
                $member->status = request()->get("status");

                $member->faculty = request()->get("faculty"); ;


                if(request()->has("nat_id") ) {
                        $member->nat_id= request()->get("nat_id");
                                                
                }
                
                
                if(request()->has("password") && request()->get("password") != null ) {
                        $member->password= request()->get("password");
                } 
                
                
                $member->fullname= $fullname;
                $member->phone= $phone;
                $member->gender= $gender;
                
                $member->logout= 1;
                
                if($member->save()) {
                        session()->flash("success", "تم التعديل بنجاح");
                        return redirect("/admin/members");
                } else {
                        return "<h1> error, something wrong happened</h1>";
                }//TODO(walid): handle errors properly;

                
        }



        
        public function getAddMember() {
                
                return view("admin/addMember");
        } 

       
        //TODO(walid): it's too late, finish the validator later;
        public function postAddMember()
        {


                $requestData= request()->all();
                $requestData["nat_id"]  = fromEasternArabicToWestern($requestData["nat_id"]);
                if(request()->has("password")){
                        $requestData["password"]  = fromEasternArabicToWestern($requestData["password"]);
                }
                request()->replace($requestData);

                
                $validator= Validator::make(request()->all(), [
                        "fullname"=> "required",
                        "nat_id"=>"required|digits:14|unique:members",
                        // "phone"=>"required",
                        "password"=> "required",
                        // "kinship"=>"required",
                        "gender"=> "required",
                        "status"=>"required",
                        "faculty"=>"required",
                        "designation"=>"required",
                ]);

                
                if($validator->fails()) {
                        session()->flash("add-member-errors", ""    );
                        return back() ->withErrors($validator)
                                      ->withInput();
                        
                }

                $member= new \App\Models\Member();

                if(request()->hasFile("pic") && request()->file("pic") != null) {
                        $pic= "";
                        $pic=request()->file("pic");
                        $validator = Validator::make(request()->all(), ["pic"=> "between:0,2048|mimes:jpeg,png,svg,gif"]);
                        if($validator->fails()) {
                                return redirect("/profile") ->withErrors($validator)
                                                            ->withInput();
                        }

                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                        $member->pic= $pic;

                }

                

                
                $member->fullname= request()->get("fullname");
                $member->nat_id= request()->get("nat_id");
                $member->password= request()->get("password");
                $member->phone = request()->get("phone");
                $member->gender = request()->get("gender");
                if(request()->get("designation") != null) {
                        $member->designation = request()->get("designation");
                }
                $member->status = request()->get("status");

                $member->faculty = request()->get("faculty"); ;

                
                
                if(request()->hasFile("pic") && request()->file("pic") != null) {
                        $pic= "";
                        $pic=request()->file("pic");
                        $validator = Validator::make(request()->all(), ["pic"=> "between:0,2048|mimes:jpeg,png,svg,gif"]);
                        if($validator->fails()) {
                                return redirect("/profile") ->withErrors($validator)
                                                            ->withInput();
                        }

                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                        $member->pic= $pic;

                }

                
                if($member->save()) {
                        session()->flash("success", "تم إضافة العضو بنجاح");
                        return redirect("/admin/members");
                } else {
                        return "<h1>error, something wrong happened </h1>";
                }

        }


        

        public function editRelative($id) {
                //TODO(walid): so if it will ever be needed;
        }
        


        public function postDeleteMember($id) {
                if(!isAllowed(["admin"])){
                        return back();
                }

                $member = \App\Models\Member::find($id);
                $pic = $member->pic;
                if($member->delete()) {
                        if($pic != null) {
                                deletePicFromDisk($pic);
                        }

                        session()->flash("success", "تم حذف العضو بنجاح");
                        return redirect("/admin/members");
                } else {
                        session()->flash("error", "حدثت مشكلة أثناء محاولة حذف العضو");
                        return redirect("/admin/members");
                } 
        } 
        
        
}
