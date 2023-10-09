<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Member;



class LoginController extends Controller
{

        public function getLogin() {
                return view("login");
        }


        public function postLogin() {
                
                $requestData= request()->all();
                $requestData["nat_id"]  = fromEasternArabicToWestern($requestData["nat_id"]);
                if(request()->has("password")){
                        $requestData["password"]  = fromEasternArabicToWestern($requestData["password"]);
                }
                request()->replace($requestData);


                $nat_id= request()->get("nat_id");
                $password= request()->get("password");

                $validation_errors = [];
                
                if($nat_id == null) {
                        $validation_errors[] = "الرقم القومي مطلوب";
                        session()->flash("errors", $validation_errors);
                        return back();
                } else if (strlen($nat_id) != 14) {
                        $validation_errors[] = "الرقم القومي يجب أن يتكون من 14 رقم";
                        session()->flash("errors", $validation_errors);
                        return back();
                }
                
                $member= Member::where([
                        ["nat_id", "=", $nat_id]
                ])->with("relatives")->first();


                if($member) {
                        $password = $member->password;
                        if($password == null) {
                                $member->logout=0;
                                $member->save();
                                session()->put("user", $member);
                                session()->put("login_role", "member");
                                return redirect("/profile");
                                
                                
                        } else if ($password != null && request()->get("password") == null){ 
                                session()->flash("use_password", "");
                                session()->flash("old_nat", $member->nat_id);
                                return back();
                                
                        } else if ($password != null && request()->get("password")) {

                                if($member-> password == request()->get("password")) {
                                        //TODO(walid): hash the password;

                                        $member->logout=0;
                                        $member->save();
                                        session()->put("user", $member);
                                        session()->put("login_role", "member");
                                        return redirect("/profile");
                                        
                                } else {
                                        session()->flash("errors",  ["الرقم القومي أو كلمة المرور غير صحيحين"]);
                                        session()->flash("use_password",  true);

                                        return back();
                                }
                                
                        }//handle normal login;

                }else {
                        session()->flash("errors",  ["هذا العضو غير موجود! تأكد من الرقم القومي"]);
                        return back();
                        

                } // no member


        }


        public function logout(){
                session()->flush();
                return redirect("/login");
        }
        
}
