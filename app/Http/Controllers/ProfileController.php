<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{



        
        public function getProfile ()
                
        {
                $kinships = \App\Models\Kinship::all();
                
                return view("profile")->with([

                        "user" => session()->get("user"),
                        "kinships"=> $kinships,
                ]);

        }




        public function editMember($id)
        {

                $current_user= session()->get("user");
                $current_member_id= session()->get("user")->id;

                if($current_member_id != $id) {
                        return "error";
                }

                
                $requestData= request()->all();

                if(request()->has("nat_id")){

                        $requestData["nat_id"]  = fromEasternArabicToWestern($requestData["nat_id"]);
                }
                if(request()->has("password")){
                        $requestData["password"]  = fromEasternArabicToWestern($requestData["password"]);
                }
                request()->replace($requestData);

                
                $validator= Validator::make(request()->all(), [
                        "phone"=>  Rule::requiredIf($current_user->password == null),
                        "password"=> Rule::requiredIf($current_user->password == null),
                        "pic"=> Rule::requiredIf($current_user->password == null),
                ], ["pic.required"=> "الصورة مطلوبة"],[]);
                
                

                
                

                
                if($validator->fails()) {
                        session()->flash("edit-member-errors", ""    );
                        return redirect("/profile") ->withErrors($validator)
                                                    ->withInput();
                        
                }
                
                // $current_user->fullname= request()->get("fullname");

                if(request()->has("phone") && request()->get("phone") != null){
                        $current_user->phone = request()->get("phone");
                }

                if(request()->has("gender") && request()->get("gender") != null){
                        $current_user->gender = request()->get("gender");

                }

                

                if(request()->has("password") && request()->get("password") != null){
                        $current_user->password= request()->get("password");
                }
                // if(request()->get("designation") != null) {
                //         $current_user->designation = request()->get("designation");
                // }

                if(request()->hasFile("pic") && request()->file("pic") != null) {
                        $pic= "";
                        $pic=request()->file("pic");
                        $validator = Validator::make(request()->all(), ["pic"=> "between:0,2048|mimes:jpeg,png,svg,gif"]);
                        if($validator->fails()) {
                                session()->flash("edit-member-errors", ""    );

                                return redirect("/profile") ->withErrors($validator)
                                                            ->withInput();
                        }

                        if($current_user->pic != null) {
                                deletePicFromDisk($current_user->pic);
                        }



                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                        $current_user->pic= $pic;

                }

                
                if($current_user->save()) {
                        session()->put("user", $current_user);
                        session()->flash("success", "تم التعديل بنجاح");
                        return back();
                } else {
                        session()->flash("error", "حدث خطأ ما أثناء التعديل");
                        return back();
                } 

        }


        


        

        
        
        
        

}
