<?php

use Illuminate\Support\Facades\Route;



Route::get("/uploads/{id}", function($id=null){
    if (!file_exists(storage_path()."/app/uploads/".$id)) {
        return response()->json(["status" => "error", 'message'=>"file dosn't exist"])->setStatusCode(404);
    }
    return response()->file(storage_path(). "/app/uploads/" .$id);
});




Route::get("/", "\App\Http\Controllers\HomeController@index");

Route::middleware([\App\Http\Middleware\LogUserOut::class])->group(function () {

        Route::get("/login", "App\Http\Controllers\LoginController@getLogin")
                ->withoutMiddleware([\App\Http\Middleware\LogUserOut::class]);


        Route::post("/login", "App\Http\Controllers\LoginController@postLogin")
                ->withoutMiddleware([\App\Http\Middleware\LogUserOut::class]);
        

        Route::get("/profile", "App\Http\Controllers\ProfileController@getProfile")
                ->middleware("checkMemberLogin");

        Route::post("/edit-member/{id}",
                    "App\Http\Controllers\ProfileController@editMember" )
                ->middleware("checkMemberLogin");


        Route::post("/add-relative",
                    "App\Http\Controllers\FamilyRelativeController@addRelative")
                ->middleware("checkMemberLogin");

        Route::post("/edit-relative/{id}",
                    "App\Http\Controllers\FamilyRelativeController@editRelative")
                ->middleware("checkMemberLogin");

        Route::post("/delete-relative/{id}",
                    "App\Http\Controllers\FamilyRelativeController@deleteRelative")
                ->middleware("checkMemberLogin");



        Route::get("/polls/", "App\Http\Controllers\MemberPollController@index")
                ->middleware("checkMemberLogin");


        Route::get("/polls/{id}", "App\Http\Controllers\MemberPollController@takePoll")
                ->middleware("checkMemberLogin");


        Route::post("/polls/save-answers/", "App\Http\Controllers\MemberPollController@saveAnswers")
                ->middleware("checkMemberLogin");




        Route::get("/logout", "App\Http\Controllers\LoginController@logout")
                ->middleware("checkMemberLogin");

        //////////////////////////////////////////////////////

        Route::get("/admin", "App\Http\Controllers\AdminController@index")
                ->middleware("checkIfMod");
        
        Route::get("/admin/info", "App\Http\Controllers\AdminInfo@index")
                ->middleware("checkIfMod");
        
        
        Route::get("/admin/mods/login", "App\Http\Controllers\ModsController@getLogin")
                ->withoutMiddleware([\App\Http\Middleware\LogUserOut::class]);
                                
        Route::post("/admin/mods/login", "App\Http\Controllers\ModsController@postLogin")
               ->withoutMiddleware([\App\Http\Middleware\LogUserOut::class]);
        

        
        Route::get("/admin/mods", "App\Http\Controllers\ModsController@allMods")
                ->middleware("checkIfMod");



        Route::get("/admin/mods/add-mod", "App\Http\Controllers\ModsController@getAddMod")
                ->middleware("checkIfMod");
        Route::post("/admin/mods/add-mod", "App\Http\Controllers\ModsController@postAddMod")
                ->middleware("checkIfMod");



        Route::get("/admin/mods/edit/{id}", "App\Http\Controllers\ModsController@getEditMod")
                ->middleware("checkIfMod");

        Route::post("/admin/mods/edit/{id}", "App\Http\Controllers\ModsController@postEditMod")
                ->middleware("checkIfMod");


        Route::post("/admin/mods/delete/{id}", "App\Http\Controllers\ModsController@postDeleteMod")
                ->middleware("checkIfMod");



        Route::get("/admin/mods/logout", "App\Http\Controllers\ModsController@logout")
                ->middleware("checkIfMod");

        
        Route::get("/admin/mods/{id}/", "App\Http\Controllers\ModsController@viewSingleMod")
                ->middleware("checkIfMod");

        
        ///////////////////////////////////////




        Route::get("/admin/members", "App\Http\Controllers\AdminController@viewMembers")
                ->middleware("checkIfMod");

                Route::get("/admin/members/add", "App\Http\Controllers\AdminController@getAddMember")
                ->middleware("checkIfMod");
        
        Route::post("/admin/members/add", "App\Http\Controllers\AdminController@postAddMember")
                ->middleware("checkIfMod");

        Route::post("/admin/members/delete/{id}", "App\Http\Controllers\AdminController@postDeleteMember")
                ->middleware("checkIfMod");

        
        
        Route::get("/admin/members/{id}", "App\Http\Controllers\AdminController@viewSingleMember")
                ->middleware("checkIfMod");


        
        Route::get("/admin/members/edit/{id}", "App\Http\Controllers\AdminController@getEditSingleMember")
                ->middleware("checkIfMod");

        

        Route::post("/admin/members/edit/{id}", "App\Http\Controllers\AdminController@postEditSingleMember")
                ->middleware("checkIfMod");

        Route::post("/admin/members/edit-relative/{id}", "App\Http\Controllers\AdminController@editRelative")
                ->middleware("checkIfMod");



        Route::get("/admin/polls", "App\Http\Controllers\PollController@index")
                ->middleware("checkIfMod");



        Route::get("/admin/polls/add", "App\Http\Controllers\PollController@getAddSinglePoll")
                ->middleware("checkIfMod");


        Route::post("/admin/polls/add" ,"App\Http\Controllers\PollController@postAddSinglePoll")
                ->middleware("checkIfMod");




        Route::get("/admin/polls/{id}", "App\Http\Controllers\PollController@viewSinglePoll")
                ->middleware("checkIfMod");



        Route::get("/admin/polls/edit/{id}", "App\Http\Controllers\PollController@getEditSinglePoll")
                ->middleware("checkIfMod");



        Route::post("/admin/polls/edit/{id}", "App\Http\Controllers\PollController@postEditSinglePoll")
                ->middleware("checkIfMod");

        Route::post("/admin/polls/delete/{id}", "App\Http\Controllers\PollController@postDeleteSinglePoll")
                ->middleware("checkIfMod");


        Route::get("/admin/polls/{id}/add-question", "App\Http\Controllers\PollController@getAddQuestion")
                ->middleware("checkIfMod");


        Route::post("/admin/polls/{id}/add-question", "App\Http\Controllers\PollController@postAddQuestion")
                ->middleware("checkIfMod");



        Route::get("/admin/questions/edit/{id}", "App\Http\Controllers\PollController@getEditQuestion")
                ->middleware("checkIfMod");

        Route::post("/admin/questions/edit/{id}", "App\Http\Controllers\PollController@postEditQuestion")
                ->middleware("checkIfMod");


        Route::post("/admin/questions/delete/{id}", "App\Http\Controllers\PollController@postDeleteQuestion")
                ->middleware("checkIfMod");



        
        Route::get("/admin/polls/report/{id}", "App\Http\Controllers\PollController@singlePollReport")
                ->middleware("checkIfMod");

        
        Route::get("/admin/search", "App\Http\Controllers\SearchController@index")
                ->middleware("checkIfMod");


        ###################news###################
        Route::Resource("/admin/news", "App\Http\Controllers\NewsController")
                ->middleware("checkIfMod");
        
});









