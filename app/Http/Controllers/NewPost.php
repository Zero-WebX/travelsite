<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Requests\NewPostRequest;
use App\Models\posts;
use App\Models\sliders;
use App\Models\users;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;


class NewPost extends Controller
{
// Новый пост
	public function newpost(NewPostRequest $req){
		$user = Auth::user();
		$userid =$user->id;
		/// Валидация в laravel встроенная
		$post = posts::create([
			'userid' =>$userid,
			'caption' => $req->caption,
			'content' => $req->content,
			'tags' => mb_strtolower($req->tags),
			'latitude' => $req->latitude,
			'longitude' => $req->longitude,
			'cost' => $req->cost

			]);

 //Обработка слайдов
if ($req->hasFile('slides')) {
    $slides = $req->file('slides');
    $descriptions = $req->input('descriptions');

    foreach ($slides as $index => $slideFile) {
        if ($slideFile && isset($descriptions[$index])) {
            $extension = $slideFile->getClientOriginalExtension();
            $filename = $post->id . '_' . $index . '.' . $extension;

            // Сохраняем файл во временное хранилище
            $path = $slideFile->storeAs('public/slides', $filename);

            // Перемещаем в public, как ты делаешь с postimg
            rename(
                storage_path('app/public/slides/' . $filename),
                public_path('storage/slides/' . $filename)
            );

            // Сохраняем в таблицу sliders
            Sliders::create([
                'postid' => $post->id,
                'description' => substr($descriptions[$index], 0, 120),
                'slide' => 'slides/' . $filename,
            ]);
        }
    }
}


	//Проверка есть ли изображение
		if ($req->hasFile('postimg')){
			$extension = $req -> file('postimg')-> getClientOriginalExtension();
			///Создание имя файла
			$filename = $post->id. '.'.$extension;
			/////Сохранение в паку
			
//			try {
//    $req->file('postimg')->move(storage_path('app/public/postimages'), $filename);
//    \Log::info('Файл успешно сохранён', ['filename' => $filename]);
//} catch (\Exception $e) {
//    \Log::error('Ошибка при сохранении файла', ['message' => $e->getMessage()]);
//    dd('Ошибка при сохранении файла:', $e->getMessage());
//}
			
			//////
		$path =$req->file('postimg')->storeAs('public/postimages', $filename);
			
			
			rename(
    storage_path('app/public/postimages/' . $filename),
    public_path('storage/postimages/' . $filename)
);
			
			
			
		/// Сохранение пути в таблице
			
			$post-> update(['postimg'=> 'postimages/'.$filename]);
			return	redirect()->route('myprofile')->with('success', 'Ваш пост опубликован!');
			
			
			
		}
		else{
			
			$post-> update(['postimg'=> 'postimages/'.'default.png']);
			return	redirect()->route('myprofile')->with('success', 'Ваш пост опубликован!');}
		
		
	
		 
	}
	// Мои посты
	public function myposts()
{
    $user = Auth::user();
    $userid = $user->id;

    $feed = DB::table('posts')
        ->leftJoin('subscribers', function ($join) use ($userid) {
            $join->on('subscribers.hosterid', '=', 'posts.userid')
                 ->where('subscribers.subscriberid', '=', $userid);
        })
        ->leftJoin('usersrequests', function ($join) use ($userid) {
            $join->on('usersrequests.hosterid', '=', 'posts.userid')
                 ->where('usersrequests.senderid', '=', $userid);
        })
        ->join('users', 'users.id', '=', 'posts.userid')
        ->where(function ($query) {
            $query->whereNotNull('subscribers.subscriberid') // ты подписан
                  ->orWhere('usersrequests.hosterack', '=', 1); // тебе дали доступ
        })
        ->select('posts.*', 'users.name')
        ->orderBy('posts.updated_at', 'desc') // 🔥 Сортировка по обновлению
        ->paginate(6);

    return view('myposts', ['data' => $feed]);
}



public function index(Request $request)
    {
        $search = $request->input('search');

        $data = posts::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('caption', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%")
                      ->orWhere('tags', 'like', "%{$search}%");


                });
            })
            ->orderByDesc('updated_at') // ← вот это ключ
            ->paginate(6);

        return view('posts', compact('data'));
    }
	
	
	public function allpublicposts(Request $request){
    $myid = auth()->id();

    $query = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.userid')

        ->select('posts.*', 'users.name')

        ->orderBy('posts.updated_at', 'desc');

    if ($request->filled('tags')) {
        $tags = explode(' ', strtolower($request->input('tags')));
        $query->where(function ($q) use ($tags) {
            foreach ($tags as $tag) {
                $q->where('posts.tags', 'like', "%$tag%");
            }
        });
    }

    $data = $query->paginate(6)->withQueryString();

    if ($request->ajax()) {
        return view('partials.postlist', ['data' => $data])->render();
    }

    return view('posts', ['data' => $data]);
}
	
	public function onepostshow($id){
		
		
		$post = new posts();
		$sliders =DB::table('sliders')

			-> select('sliders.*')
			-> where('sliders.postid', '=',$id)
			-> get();
		
		
		$postcomments = DB::table('Comments')
			-> join('users', 'users.id', '=', 'Comments.userid')
			-> select('Comments.*','users.name')
			-> where('Comments.IdPost', '=',$id)
			-> orderby('Comments.updated_at', 'desc')
			-> get();
		
		
		
		
		
		
		//return view('myposts', ['data'=>$post-> where ('userid','=',$userid)->get()]); 
		return view('onepost', ['data'=>$post->find($id), 'comments'=>$postcomments, 'slider'=>$sliders]);
	
		 
	}
	
	public function onepostmodifyshow($id){
			
		$post = new posts();

		$sliders =DB::table('sliders')

			-> select('sliders.*')
			-> where('sliders.postid', '=',$id)
			-> get();



		
		
		
		//return view('myposts', ['data'=>$post-> where ('userid','=',$userid)->get()]); 
		return view('postmodify', ['data'=>$post->find($id), 'slider'=>$sliders]);
	
		 
	}
	public function onepostdelete($id){
	
		
		$post = new posts();
 $posts = DB::table('posts')
			
			-> select('posts.*')
			-> where('posts.id', '=',$id)	
			-> delete();	
		
		//return view('myposts', ['data'=>$post-> where ('userid','=',$userid)->get()]); 
		return	redirect()->route('myprofile')->with('success', 'Ваш пост удален!');}
	
	public function onepostmodifysave(NewPostRequest $req)
{
    $user = Auth::user();
    $userid = $user->id;

    $idpost = $req->post_id;
    $post = posts::find($idpost);

    if (!$post) {
        return redirect()->route('myprofile')->with('error', 'Пост не найден');
    }

    // Обновление основных данных
    $post->userid = $userid;
    $post->caption = $req->caption;
    $post->content = $req->content;
    $post->tags = mb_strtolower($req->tags);

    $post->latitude = $req->latitude;
    $post->longitude = $req->longitude;
    $post->cost = $req->cost;

    // Обработка изображения поста
    if ($req->hasFile('postimg')) {
        $extension = $req->file('postimg')->getClientOriginalExtension();
        $filename = $post->id . '.' . $extension;
        $path = $req->file('postimg')->storeAs('public/postimages', $filename);
        $post->postimg = 'postimages/' . $filename;

        rename(
            storage_path('app/public/postimages/' . $filename),
            public_path('storage/postimages/' . $filename)
        );
    }

    $post->save();

    // Обновление описаний существующих слайдов
    if ($req->has('existing_slide_ids') && $req->has('existing_descriptions')) {
        foreach ($req->existing_slide_ids as $index => $slideId) {
            DB::table('sliders')
                ->where('id', $slideId)
                ->update(['description' => $req->existing_descriptions[$index]]);
        }
    }

    // Добавление новых слайдов
    if ($req->hasFile('slides')) {
        foreach ($req->file('slides') as $index => $slideFile) {
            $slideName = uniqid('slide_') . '.' . $slideFile->getClientOriginalExtension();
            $slidePath = $slideFile->storeAs('public/slides', $slideName);

            rename(
                storage_path('app/public/slides/' . $slideName),
                public_path('storage/slides/' . $slideName)
            );

            DB::table('sliders')->insert([
                'postid' => $post->id,
                'slide' => 'slides/' . $slideName,
                'description' => $req->descriptions[$index] ?? '',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    return redirect()->route('myprofile')->with('success', 'Пост успешно обновлён!');
}
	
		 
	
}
