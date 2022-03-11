<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Inertia\Response;

class PostController extends Controller
{
    private $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = $this->service->getAll();
        return Inertia::render('Posts', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();
        $this->service->store($request);

        return redirect()->back()
            ->with('message', 'Post Created Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            $this->service->update($request, $request->input('id'));
            return redirect()->back()
                ->with('message', 'Post Updated Successfully.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Post::find($request->input('id'))->delete();
            $this->service->destroy($request->input('id'));
            return redirect()->back();
        }
    }

}
