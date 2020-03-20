<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = News::orderBy('created_at', 'desc')->get();
        return view('news.index', ['news' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'news_title' => 'required',
            'news_body' => 'required'
        ]);
        $upload_news = new News;
        $upload_news->news_title = $request->news_title;
        $upload_news->news_body = $request->news_body;
        $upload_news->save();
        return redirect('/news/admin/add')->with('success', 'Success add News.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = News::where('id', $id)->first();
        return view('news.show', ['news' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = News::where('id', $id)->first();
        return view('news.edit', ['news' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::where('id', $id)
                ->update([
                    'news_title' => $request->news_title,
                    'news_body' => $request->news_body
                ]);
        return redirect('/news/admin/' . $id . '/edit')->with('success', 'Success, edited data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = News::find($request->id);
        $data->delete();
        return redirect('/news/admin');
    }

    /**
     * indexAdmin function
     */
    public function indexAdmin()
    {
        $data = News::orderBy('created_at', 'desc')->get();
        return view('news.indexAdmin', ['news' => $data]);
    }

    /**
     * showAdmin function
     */
    public function showAdmin($id)
    {
        $data = News::where('id', $id)->first();
        return view('news.showAdmin', ['news' => $data]);
    }
}

