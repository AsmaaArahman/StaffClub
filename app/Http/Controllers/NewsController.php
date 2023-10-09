<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $news= \App\Models\News::all();
            return view("admin.news")->with([
                    "news"=> $news
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view("admin.createNews");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validaor= Validator::make(request()->all(), [
                    "title"=> "required",
                    "content"=> "required",
                    "image"=>"required|between:0,2048|mimes:jpeg,png,svg,gif",
                    
            ], ["content.required"=> "محتوى الخبر لا يمكن ان يكون فارغا",
                "image.required"=> "الصورة مطلوبة"
            ], []) ;

            if($validaor->fails()) {
                    return back()->withErrors($validaor)->withInput();
            }


            $title= request()->get("title");
            $content= request()->get("content");
            $active= false;
            $image= "";
            
            if(request()->has("active")){
                    if(request()->get("active") == "on"){
                            $active = 1;
                    }else if(request()->get("active") == "") {
                            $active = 0;
                    } 
            }
            

            $news=new \App\Models\News();
            $success= $this->saveNews($news,
                            $title,
                            $content,
                            $active,
                            session()->get("user")) ;

            if($success) {
                    session()->flash("success", "تم إضافة الخبر");
                    return redirect("/admin/news");
            }else {
                    session()->flash("error", "حدث خطأ ما أثناء إضافة الخبر");

            }
    }
        
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
            $featured_image= $news->news_images()
                                  ->where("featured","=", 1)->first();
            return view("admin.singleNews")->with([
                    "news"=>$news,
                    "featured_image"=>  $featured_image,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
        public function edit(News $news)
        {

                return view("admin.editNews")->with([
                        "news"=> $news,
                ]);
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
        public function update(Request $request, News $news)
        {
                $validaor= Validator::make(request()->all(), [
                        "title"=> "required",
                        "content"=> "required",
                        "image"=> "between:0,2048|mimes:jpeg,png,svg,gif"

                        
                ], ["content.required"=> "محتوى الخبر لا يمكن ان يكون فارغا",
                ], []) ;

                if($validaor->fails()) {
                        return back()->withErrors($validaor)->withInput();
                }


                $title= request()->get("title");
                $content= request()->get("content");
                $active= false;
                $image= "";
            
                if(request()->has("active")){
                        if(request()->get("active") == "on"){
                                $active = 1;
                        }else if(request()->get("active") == "") {
                                $active = 0;
                        } 
                }
                

                
                $success= $this->updateNews($news,
                                          $title,
                                          $content,
                                          $active,
                                          session()->get("user")) ;
                
                if($success) {
                        session()->flash("success", "تم تعديل الخبر");
                        return redirect("/admin/news");
                }else {
                        session()->flash("error", "حدث خطأ ما أثناء إضافة الخبر");
                        
            }

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
            $news_images= $news->news_images()->get();
            foreach($news_images as $image) {
                    deletePicFromDisk($image->image);
            }
            if($news->delete()){
                    session()->flash("success", "تم حذف الخبر");
                    return back();
            }else {
                    session()->flash("error", "حدث خطأ أثناء حذف الخبر");
                    return back();
            }
            
    }



        //helper methods;


        public function saveNews($news, $title, $content, $active,  $mod) {
                $image= "";
                $news->title= $title;
                $news->content= $content;
                $news->active=$active;
                $news->mod()->associate($mod);

                if($news->save()) {
                        //uploading the image
                        if(request()->hasFile("image")
                           && request()->file("image") != null) {
                                $returned_name=
                                             uploadImage(request()->file("image"));
                                if( $returned_name!= null){
                                        $image=$returned_name;
                                }
                        }
                
                        $news_image= new \App\Models\NewsImage();
                        $news_image->news()->associate($news);
                        $news_image->image=$image;
                        $news_image->featured= true;
                        $news_image->save();
                        return true;
                        
                } else {
                        return false;
                }
                
        }


        public function updateNews($news, $title, $content, $active,  $mod) {
                $image= "";
                $news->title= $title;
                $news->content= $content;
                $news->active=$active;
                $news->mod()->associate($mod);

                if($news->save()) {
                        //uploading the image
                        if(request()->hasFile("image")
                           && request()->file("image") != null) {
                                $image= "";
                                $image=request()->file("image");

                                //delete old featured image from db and disk;
                                $old_image= $news->news_images()->where(
                                        "featured", "=",  1
                                )->first();

                                if($old_image) {
                                        deletePicFromDisk($old_image->image);
                                        $old_image->delete();
                                }
                                
                                $returned_name=
                                              uploadImage(request()->file("image"));
                                if( $returned_name!= null){
                                        $image=$returned_name;
                                }

                                $news_image= new \App\Models\NewsImage();
                                $news_image->news()->associate($news);
                                $news_image->image=$image;
                                $news_image->featured= true;
                                $news_image->save();
                        }
                    
                        return true;

                } else {
                        return false;
                }
                
        }


}
