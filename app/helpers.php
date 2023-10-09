<?php


function isAllowed($roles)
{
        $current_user = session()->get("user");
        $available_roles = ["admin", "normal_mod", "reception"];

        if($current_user == null){
                return false;
        }
        
        foreach($roles as $index=>$role) {

                if(!in_array($role, $available_roles)){
                        return false;
                }
                //replace string roles with numeric, makes it easier to handle and compare; 
                if($role == "admin") {
                        $roles = array_replace($roles, [$index=>"1"]);
                }else if($role == "normal_mod") {
                        $roles = array_replace($roles, [$index=>"2"]);
                }else if($role == "reception") {
                       $roles =  array_replace($roles, [$index=>"3"]);
                }

                
        }
        
        if(in_array($current_user->role, $roles)) {
                return true; 
        }

        return false;        
} 


function isModLogin()
{
        
        $role= session()->get("login_role");
        if($role != "mod") {
                return false;
        }
        return true;
}


function isMemberLogin()
{
        
        $role= session()->get("login_role");
        if($role != "member") {
                return false;
        }
        return true;
}




function activePolls()
{
        $polls= \App\Models\Poll::where("active", "=", "1")->get();
        return $polls;
}


function pollVisibleToMember($member, $poll) {
        //Note(walid): those designation are always allowed to vote;
        if(!str_contains($member->designation, "رئيس الجامعة")){
                $allowedVotersArr = explode(",", $poll->allowedVoters);

                if(in_array( "استاذ" , $allowedVotersArr)){
                        array_push($allowedVotersArr, "أستاذ"); //NOTE(walid): easy way to deal with hamza; 
                }
                foreach($allowedVotersArr as $a) {
                        if(str_contains($member->designation, $a)) {
                                return true;
                        } 
                }
                return false;
        }else {
                return true;
        } 
} 

function memberAllowedToVote($member, $poll)
{
        
        $poll_voter= \App\Models\PollVoters::where([["member_id", "=", $member->id], ["poll_id", "=", $poll->id]])->get();
        if(count($poll_voter) > 0) {
                return false && pollVisibleToMember($member, $poll);
        }else {
                return true && pollVisibleToMember($member, $poll);
        } 
} 


function isAnyPollsToVote()
{
        $active_polls= activePolls();
        if(count($active_polls) > 0) {
                foreach($active_polls as $poll) {
                        if(memberAllowedToVote(session()->get("user"), $poll)) {
                                return true;
                        } 
                } 
        }else {
                return false;
        } 

        return false;
} 


function fromEasternArabicToWestern($str)
{
        $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
        $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        
        $str = str_replace($eastern_arabic, $western_arabic, $str);
        return $str;
} 





function deletePicFromDisk($pic)
{
        if($pic == "default.jpg") {
                return false;
        } 
        $file = storage_path()."/app/uploads/" . $pic;
        if (file_exists($file)) {
                if (File::delete($file)) {
                        return true;
                }
        }

        return false;
}




function getTitleSlug($title, $required_slug)
{
        $slug = explode("-", $title)[0];
        if($slug == $required_slug) {
                return "active";
        }else {
                return "";
        } 
}


function uploadImage($file) {

        $name= $file->store("uploads");
        if(!$name) {
                return null;
        }
        $name=substr($name, strlen("uploads/"));
        return $name;

}
