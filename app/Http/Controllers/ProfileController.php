<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewPostRequest;
use App\Http\Requests\SubscribeRequest;
use App\Http\Requests\UserToRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\posts;
use App\Models\User;
use App\Models\subscribers;
use App\Models\usersrequests;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
	
{
	public function showMeMyProfile(){
		
		$user = Auth::user();
		$userid =$user->id;
		
		
	
		
		
		$myposts = DB::table('posts')
			-> join('users', 'users.id', '=', 'posts.userid')
			-> select('posts.*','users.name')
			-> where('posts.userid', '=',$userid)
			-> orderby('posts.updated_at', 'desc')
			-> paginate(6);
		
		
		
			
		
		
			return view('myprofilepublic', ['userdata'=>$user, 'myposts'=>$myposts]);
	}
	
	
	
	public function showUserProfile($id){
        
		
		$user = User::find($id);
		
		
	////////////////////////////////////////////////////////
		
	////////  Проверка подписан ли на полльзователя//////////
		$usermy = Auth::user();
		$userid =$usermy->id;
		
		$exists = subscribers::where('hosterid', $id)
    ->where('subscriberid',$userid)
    ->exists();
		
		
		
		if ($exists) {
			$i_subscribed = "disabled";
			$i_am_not_subscribed ="";
   
       } else {
    
			$i_am_not_subscribed ="disabled";
			$i_subscribed = "";
        }
	/////////////////////////////////////////////////////////	
		
		
		/////////////////Отправлен ли запрос пользователю//////////////////
		
		$existsreq = usersrequests::where('hosterid', $id)
    ->where('senderid',$userid)
    ->exists();
		
		
		if ($existsreq) {
			$requestsend = "disabled";
			$i_am_not_subscribed ="";
   
       } else {
    
			$requestsend = "";
			
        }
		
//		if ($user_id =$userid ){
//			
//		$requestsend = "hidden";	
//		}
//		
		
		////////////////////////////////////////////
		
		
		  if($userid ==  $id){
			  $i_subscribed = "hidden";
			$i_am_not_subscribed ="hidden";
			  $requestsend = "hidden";
			  
		  };
		
		
		$myposts = DB::table('posts')
			-> join('users', 'users.id', '=', 'posts.userid')
			-> select('posts.*','users.name')
			-> where('posts.userid', '=',$id)
			-> orderby('posts.updated_at', 'desc')
			-> paginate(4);
		
		
		
			
		
		
			return view('profilepublic', ['userdata'=>$user, 'data'=>$myposts, 'subscribed'=>$i_subscribed, 'unsubscribe' => $i_am_not_subscribed, 'requestsend'=>$requestsend]);
	}
    
    
    public function myProfile(){
        
        $usermy = Auth::user();
		$userid =$usermy->id;
        $id = $usermy->id;
		
		$user = User::find($id);
		
		
	////////////////////////////////////////////////////////
		
	////////  Проверка подписан ли на полльзователя//////////
		
		
		$exists = subscribers::where('hosterid', $id)
    ->where('subscriberid',$userid)
    ->exists();
		
		
		
		if ($exists) {
			$i_subscribed = "disabled";
			$i_am_not_subscribed ="";
   
       } else {
    
			$i_am_not_subscribed ="disabled";
			$i_subscribed = "";
        }
	/////////////////////////////////////////////////////////	
		
		
		/////////////////Отправлен ли запрос пользователю//////////////////
		
		$existsreq = usersrequests::where('hosterid', $id)
    ->where('senderid',$userid)
    ->exists();
		
		
		if ($existsreq) {
			$requestsend = "disabled";
			$i_am_not_subscribed ="";
   
       } else {
    
			$requestsend = "";
			
        }
		
//		if ($user_id =$userid ){
//			
//		$requestsend = "hidden";	
//		}
//		
		
		////////////////////////////////////////////
		
		
		  if($userid ==  $id){
			  $i_subscribed = "hidden";
			$i_am_not_subscribed ="hidden";
			  $requestsend = "hidden";
			  
		  };
		
		
		$myposts = DB::table('posts')
			-> join('users', 'users.id', '=', 'posts.userid')
			-> select('posts.*','users.name')
			-> where('posts.userid', '=',$id)
			-> orderby('posts.updated_at', 'desc')
			-> paginate(4);
		
		
		
			
		
		
			return view('myprofile', ['userdata'=>$user, 'data'=>$myposts, 'subscribed'=>$i_subscribed, 'unsubscribe' => $i_am_not_subscribed, 'requestsend'=>$requestsend]);
	}
	

public function modifyprofile(ProfileRequest $req){
		$user = Auth::user();
		$id =$user->id;

		$user = User::find($id);

		$user-> update(['name'=> $req->name,
						'aboutme'=> $req->aboutme,
						 ]);



	//Проверка есть ли изображение
		if ($req->hasFile('img')){
			$extension = $req -> file('img')-> getClientOriginalExtension();
			///Создание имя файла
			$filename = 'user'.$id. '.'.$extension;
			/////Сохранение в паку


		$path =$req->file('img')->storeAs('public/postimages', $filename);


			rename(
    storage_path('app/public/postimages/' . $filename),
    public_path('storage/postimages/' . $filename)
);



		/// Сохранение пути в таблице

			$user-> update(['img'=> 'postimages/'.$filename]);
			return	redirect()->route('myprofile')->with('success', 'Данные профиля обновлены!');



		}
		else{

			$user-> update(['postimg'=> 'postimages/'.'default.png']);
			return	redirect()->route('myprofile')->with('success', 'Данные профиля обновлены!');}




	}


	
	public function subscribetouser(SubscribeRequest $req){
		
		/*
		$req 
		
		
		*/
		$user_id = $req->subscriber_id;
		
		$user = Auth::user();
		$userid =$user->id;
		
		$subscribe = subscribers::create([
			'subscriberid' =>$userid ,
			'hosterid' => $user_id	
			]);
		
		
		return	redirect()->route('profilepublic', $user_id)->with('success', 'Вы успешно подписались!');
		
	}
	
	public function requesttouser(SubscribeRequest $req){
		
		/*
		$req 
		
		
		*/
		$user_id = $req->subscriber_id;
		
		$user = Auth::user();
		$userid =$user->id;
		
		$subscribe = usersrequests::create([
			'senderid' =>$userid ,
			'hosterid' => $user_id	
			]);
		
		
		return	redirect()->route('profilepublic', $user_id)->with('success', 'Вы успешно отправили запрос!');
		
	}
	
	
	
	public function  unsubscribetouser(SubscribeRequest $req){
		
		
		
		
		
		
		$user_id = $req->subscriber_id;
		subscribers::where('hosterid', $user_id)->delete();
		
		
		
		return	redirect()->route('profilepublic', $user_id)->with('success', 'Вы успешно отписались!');
		
	}
	
		public function incomingrequests(){
		$user = Auth::user();
		$userid =$user->id;
			
		
		
		$userrequest = DB::table('usersrequests')
			-> join('users', 'users.id', '=', 'usersrequests.senderid')
			-> select('usersrequests.*', 'users.name')
			-> where('usersrequests.hosterid', '=', $userid)
			-> where('usersrequests.hosterack', '=', 0)
			-> where('usersrequests.hostercanceled', '=', 0)
			-> orderby('usersrequests.updated_at', 'desc')
			-> get();
			
		$user_rejected_requests = DB::table('usersrequests')
			-> join('users', 'users.id', '=', 'usersrequests.senderid')
			-> select('usersrequests.*', 'users.name')
			-> where('usersrequests.hosterid', '=', $userid)
			-> where('usersrequests.hosterack', '=', 0)
			-> where('usersrequests.hostercanceled', '=', 1)
			-> orderby('usersrequests.updated_at', 'desc')
			-> get();	
			
			
		$useroutrequest = DB::table('usersrequests')
			-> join('users', 'users.id', '=', 'usersrequests.hosterid')
			-> select('usersrequests.*', 'users.name')
			-> where('usersrequests.senderid', '=', $userid)
			-> where('usersrequests.hosterack', '=', 0)
			-> orderby('usersrequests.updated_at', 'desc')
			-> get();	
			
			//-> paginate(4);
			//			
		
		//return view('myposts', ['data'=>$post-> where ('userid','=',$userid)->get()]); 
		return view('incommingrequests', ['data'=>$userrequest, 'dataout'=>$useroutrequest, 'datacanceledrequests'=>$user_rejected_requests]);
			
			
			
		}
	
	public function acknowledgerequest(UserToRequest $req){
		$userreqid =  $req->requestid;
		
		$usersrequest = usersrequests::find($userreqid);
		$usersrequest->hosterack="1";
		$usersrequest-> update();
			
		return	redirect()->route('incommingrequests')->with('success', 'Запрос был принят!');
	}
	
	public function rejecterequest(UserToRequest $req){
		$userreqid =  $req->requestid;
		
		$usersrequest = usersrequests::find($userreqid);
		$usersrequest->hostercanceled="1";
		$usersrequest-> update();
			
		return	redirect()->route('incommingrequests')->with('success', 'Запрос был отклонен!');
	}
    //
}
