<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Http\Requests\commentreq;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Pagination\Paginator;
use App\Models\comments;
use App\Models\posts;

use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    //
	
	public function newcomment(commentreq $req){
		$user = Auth::user();
		$userid =$user->id;
		
		$comment = comments::create([
			'IdPost' => $req->post_id,
			'userid' =>$userid,
			'comment' => $req->content
			
			
			]);
		
		return	redirect()->route('onepost', ['id' => $req->post_id])->with('success', 'Ваш комментарий опубликован!');}
		
	}

