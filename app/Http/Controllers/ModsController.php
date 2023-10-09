<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModsController extends Controller
{


        //TODO(walid): do delete;

        public function getLogin() {
                return view("admin/modsLogin");
        } 


        public function postLogin(Request $request) {

                $requestData= request()->all();
                $requestData["nat_id"]  = fromEasternArabicToWestern($requestData["nat_id"]);
                $requestData["password"]  = fromEasternArabicToWestern($requestData["password"]);
                request()->replace($requestData);
                
                

                
                
                $validation = Validator::make(request()->all(),[
                        "nat_id"=> "required|digits:14",
                        "password"=> "required"
                ]);

                if($validation->fails()) {
                        return back()->withErrors($validation)->withInput();
                }


                $nat_id= request()->get("nat_id");
                $password= request()->get("password");

                $mod= \App\Models\Mod::where([
                        ["nat_id", "=", $nat_id],
                        ["password", "=", $password]
                ])->first();

                
                if($mod != null) {
                        $mod->logout=0;
                        $mod->save();
                        session()->put("user", $mod);
                        session()->put("login_role", "mod");
                        // return view("admin/index");
                        return redirect("/admin/");
                }else {
                        $validation->getMessageBag()->add(
                                "nat_id",
                                "لم يتم العثور على المستخدم!"
                        );
                        return back()->withErrors($validation);
                }                 
                
        }



        
        public function allMods() {
                
                $mods= \App\Models\Mod::all();
                return view("admin/mods")->with(["mods"=>$mods]);
        }
        

        public function viewSingleMod($id){
                $mod = \App\Models\Mod::find($id);
                return view("admin/viewSingleMod")->with([
                        "mod"=>$mod
                ]);                
                
        } 
        
        
        public function getAddMod() {
                if(!isAllowed(["admin"])) {
                        return back();
                } 


                return view("admin/addMods");
                
        } 
        
        
        public function postAddMod() {
                if(!isAllowed(["admin"])) {
                        return back();
                } 


                
                $mod= new \App\Models\Mod();

                $requestData= request()->all();
                $requestData["nat_id"]  = fromEasternArabicToWestern($requestData["nat_id"]);
                if(request()->has("password")){
                        $requestData["password"]  = fromEasternArabicToWestern($requestData["password"]);
                }
                request()->replace($requestData);

                
                $validator = Validator::make(request()->all(),[
                        "fullname" => "required:digits",
                        "nat_id"=> "required|digits:14|unique:mods",
                        "password"=> "required",
                        "gender" => "required",
                        "role" => "required"
                ]);

                if($validator->fails()) {
                        return back()->withErrors($validator)->withInput();
                }
                

                if(request()->hasFile("pic") && request()->file("pic") != null) {
                        $pic= "";
                        $pic=request()->file("pic");
                        $validator->getMessageBag()->add("pic", "between:0,2048|mimes:jpeg,png,svg,gif");
                        if($validator->fails()) {
                                return back()->withErrors($validator)
                                             ->withInput();
                        }
                        
                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                        $mod->pic= $pic;
                }


                $mod->fullname= request()->get("fullname");
                $mod->nat_id= request()->get("nat_id");
                $mod->password= request()->get("password");
                $mod->gender= request()->get("gender");
                $mod->phone= request()->get("phone");
                $mod->role = request()->get("role");
                        
                if($mod->save()) {
                        session()->flash("success", "تم إضافة المشرف بنجاح");
                        return redirect("admin/mods");
                }else {
                        session()->flash("success", "حدث خطأ ما أثناء إضافة المشرف");
                        return redirect("admin/mods");

                }                 
        }



        public function getEditMod($id) {

                if(!isAllowed(["admin"]) && session()->get("user")->id != $id ) {
                        return back();
                }

                $mod = \App\Models\Mod::find($id);
                return view("admin/editMods")->with([
                        "mod"=>$mod
                ]);
        }
        

        public function postEditMod($id) {
                
                if(!isAllowed(["admin"]) && session()->get("user")->id != $id ) {
                        return back();
                }

                
                $mod = \App\Models\Mod::find($id);

                $requestData= request()->all();
                $requestData["nat_id"]  = fromEasternArabicToWestern($requestData["nat_id"]);
                if(request()->has("password")){
                        $requestData["password"]  = fromEasternArabicToWestern($requestData["password"]);
                }
                request()->replace($requestData);

                $validator = Validator::make(request()->all(),[
                        "fullname" => "required:digits",
                        "nat_id"=> "required|digits:14|unique:mods,nat_id,".$mod->id,
                        // "password"=> "required",
                        "gender" => "required",
                        // "role"=>"required"
                ]);

                if($validator->fails()) {
                        return back()->withErrors($validator)->withInput();
                }
                

                if(request()->hasFile("pic") && request()->file("pic") != null) {
                        $pic= "";
                        $pic=request()->file("pic");
                        $validator->getMessageBag()->add("pic", "between:0,2048|mimes:jpeg,png,svg,gif");
                        if($validator->fails()) {
                                return back()->withErrors($validator)
                                             ->withInput();
                        }

                        if($mod->pic != null) {
                                deletePicFromDisk($mod->pic);
                        }

                        $name= $pic->store("uploads");
                        $name=substr($name, strlen("uploads/"));
                        $pic=$name;
                        $mod->pic= $pic;
                }


                $mod->fullname= request()->get("fullname");
                $mod->nat_id= request()->get("nat_id");
                if(request()->has("password") && request()->get("password") != null) {
                        dd(request()->all());
                        $mod->password= request()->get("password");
                }
                $mod->gender= request()->get("gender");
                $mod->phone= request()->get("phone");


                if(isAllowed(["admin"])){
                                $mod->role = request()->get("role");
                }
                $mod->logout = 1;
                if($mod->save()) {
                        session()->flash("success", "تم تعديل المشرف بنجاح");
                        return redirect("admin/mods");
                }else {
                        session()->flash("success", "حدث خطأ ما أثناء تعديل المشرف");
                        return redirect("admin/mods");

                }                 

        }

        
        public function postDeleteMod($id) {
                $mod = \App\Models\Mod::find($id);

                if(!isAllowed(["admin"]) || $mod->role != 1) {
                        return back();
                }

                $pic=$mod->pic;
                if($mod->delete()) {
                        if($pic != null) {
                                deletePicFromDisk($pic);
                        }

                        session()->flash("success", "تم حذف المشرف بنجاح");
                        return redirect("admin/mods");
                }else {
                        session()->flash("success", "حدث خطأ ما أثناء حذف المشرف");
                        return redirect("admin/mods");

                }  
        }  



        public function logout(){
                session()->flush();
                return redirect("/admin/mods/login");
        }

        
}

