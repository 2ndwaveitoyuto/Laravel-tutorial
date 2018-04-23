<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index(Request $request)
    {

        $keywords = $request->input('keywords');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        
        
        //検索ワードが入力されていたら、ワード検索を実行する
        if ($keywords != null) {
        $posts = Post::where('title','like','%'.$keywords.'%')
            ->orWhere('content','like','%'.$keywords.'%')
            ->orderBy('id', 'desc')->paginate(20);
        }else if ($from_date != null && $to_date != null) {
            $posts = Post::wherebetween('created_at', [$from_date, $to_date])->paginate(20);
        //何も入力されていなければ、テーブル全体を取得
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(20);
    
        }
     
         return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $post = new Post();

        return view('posts.create', compact('post'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'title' => 'required|min:3',           
            'content' => 'required|min:1'   
        ]);

        $post = Post::create($request->all());
        $post->save();
        \Session::flash('flash_message', '記事を登録しました。');
        return redirect()->route('posts.index');
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'title' => 'required|min:3',           
            'content' => 'required|min:1'
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
    
    

}
