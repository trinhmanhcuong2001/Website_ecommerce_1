<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Comment\CommentService;

class CommentController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService){
        $this->commentService = $commentService;
    }

    public function addComment(Request $request){
        $result = $this->commentService->addComment($request);
        $html = view('comment.show', ['comment' => $result])->render();
        return response()->json([
            'html' => $html
        ]);
    }
    public function loadComment(Request $request){
        $product_id = $request->input('product_id');
        $page = $request->input('page');
        $result = $this->commentService->loadComment($product_id, $page);
        $html = view('comment.list', ['comments' => $result['comments']])->render();
        $totalPage = $result['totalPage'];
        return response()->json([
            'html' => $html,
            'totalPage' => $totalPage
        ]);
    }
}
