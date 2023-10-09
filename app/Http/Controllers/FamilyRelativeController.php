<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class FamilyRelativeController extends Controller
{
                
        
        public function addRelative()
        {
                // dd(request()->all());

                                
                $requestData= request()->all();
                if(request()->has("nat_id")){
                        $requestData["nat_id"]  = fromEasternArabicToWestern($requestData["nat_id"]);
                }
                request()->replace($requestData);
                

                
                $validator= Validator::make(request()->all(), [
                        "fullname"=> "required",
                        "nat_id"=> "required|digits:14",
                        "kinship"=>"required",
                        "pic" => "required"
                ], ["pic.required" => "الصورة مطلوبة"],[]);

                if($validator->fails()) {
                        session()->flash("add-relative-errors");
                        return redirect("/profile") ->withErrors($validator)
                        ->withInput();
                }

                $relative= new \App\Models\FamilyRelative();

                
                $fullname= request()->get("fullname");
                $nat_id= request()->get("nat_id");
                $req_kinship= request()->get("kinship");
                
                if(request()->hasFile("pic") && request()->file("pic") != null) {
                        $pic= "";
                        $pic=request()->file("pic");
                        $validator = Validator::make(request()->all(), ["pic"=> "between:0,2048|mimes:jpeg,png,svg,gif"]);
                        if($validator->fails()) {
                                session()->flash("add-relative-errors");

                                return redirect("/profile") ->withErrors($validator)
                                                            ->withInput();
                        }

                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                                        $relative->pic= $pic;

                }

                
                $kinship= \App\Models\Kinship::find($req_kinship);
                if($kinship == null) {
                        return "error";
                } //TODO(walid): handle error properly;
                
                $relative->fullname= $fullname;
                $relative->nat_id= $nat_id;
                $relative->kinship()->associate($kinship);

                //NOTE(walid): the condition will controll which memeber
                //is associated with the relative;
                if(true) {
                        $relative->member()->associate(session()->get("user"));
                }
                
                if($relative->save()) {
                        session()->flash("success", "تم الإضافة بنجاح");
                        return back();
                }
                
                
        }
        
        
        public function editRelative($relativeId)
        {
                

                $relative= \App\Models\FamilyRelative::find($relativeId);

                                
                $validator= Validator::make(request()->all(), [
                        "fullname"=> "required",
                        "nat_id"=> "required|digits:14",
                        "kinship"=>"required",
                        "pic" => Rule::requiredIf($relative->pic == null),
                ],["pic.required" => "الصورة مطلوبة"],[]);

                if($validator->fails()) {
                        session()->flash("edit-relative-errors");
                        return redirect("/profile") ->withErrors($validator)
                        ->withInput();
                } 


                
                $fullname= request()->get("fullname");
                $nat_id= request()->get("nat_id");
                $age= request()->get("age");
                $req_kinship= request()->get("kinship");
                $gender="";
                
                // dd(request()->all());
                if(request()->hasFile("pic") || request()->file("pic") != null) {
                        $pic="";
                        $pic=request()->file("pic");
                        $validator = Validator::make(request()->all(), ["pic"=> "between:0,2048|mimes:jpeg,png,svg,gif"]);
                        if($validator->fails()) {
                                session()->flash("edit-relative-errors");
                                return redirect("/profile") ->withErrors($validator)
                                                            ->withInput();
                        }

                        if($relative->pic != null) {
                                deletePicFromDisk($relative->pic);
                        }

                        
                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                        $relative->pic= $pic;

                }

                
                $kinship= \App\Models\Kinship::find($req_kinship);
                if($kinship == null) {
                        return "error";
                } //TODO(walid): handle error properly;
                

                $relative -> fullname= $fullname;
                $relative -> nat_id= $nat_id;
                if($req_kinship == "son"
                   || $req_kinship == "father"
                   || $req_kinship == "husband"
                   || $req_kinship == "brother")
                {
                        
                        $gender="male";
                }else {
                        $gender="female";
                }

                $relative->gender=$gender;
                $relative->age= $age;
                $relative -> kinship()->associate($kinship);
                
                if($relative->save()) {
                        session()->flash("success",
                                         "تم التعديل بنجاح"
                        );
                        return back();
                }
                        
        }


        public function deleteRelative($id) {
                $relative= \App\Models\FamilyRelative::find($id);
                $pic = $relative->pic;
                
                if($relative != null) {
                        $relative->delete();
                        if($pic != null) {
                                deletePicFromDisk($pic);
                        }

                        session()->flash("delete-relative-success", "تم الحذف بنجاح");
                        return back();
                } else {
                        session()->flash("delete-relative-errors", "لم يتم العثور على القريب!");
                        return back();
                }
        }
        
}
