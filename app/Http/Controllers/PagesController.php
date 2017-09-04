<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use CMS\TestThread;
use Illuminate\Support\Facades\Auth;
use Pinger\Pages\Models\Page;
use Illuminate\Http\Request;
use Pinger\Pages\Requests\PageRequest;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'showByAlias']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest()) {
           $pages = null;
        } else {
            $pages = Page::all();
        }

        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Pinger\Pages\Requests\PageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        Page::create([
                'title' => request('title'),
                'alias' => request('alias'),
                'content' => request('content'),
                'in_menu' => boolval(request('in_menu'))
            ]
        );

        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Pinger\Pages\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Pinger\Pages\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Pinger\Pages\Requests\PageRequest $request
     * @param  \Pinger\Pages\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update([
            'title' => request('title'),
            'alias' => request('alias'),
            'content' => request('content'),
            'in_menu' => boolval(request('in_menu'))
        ]);

        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Pinger\Pages\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('pages.index');
    }

    public function showByAlias(string $alias)
    {
        $page = (new Page)->getByAlias($alias);
        return view('pages.show', compact('page'));
    }
}
