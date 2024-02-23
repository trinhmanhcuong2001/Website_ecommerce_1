<?php

namespace App\Http\Services\Comment;
use App\Models\Comment;

class CommentService {
    public function addComment($request){

        $comment = Comment::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'content' => $request->input('content'),
            'product_id' => $request->input('product_id'),
        ]);
        return $comment;
    }
    public function loadComment($product_id, $page = 1){
        $totalRecords  = Comment::where('product_id', $product_id)->count();
        $totalPage = ceil($totalRecords / 2);
        // Số bản khi bắt đầu từ 0 nên khi lấy cần -1 ví dụ page = 2 sẽ lấy từ bản ghi số 1 * 2, page = 3 là 2*2
        $comments = Comment::where('product_id', $product_id)->orderByDesc('id')->when($page != 1, function ($query) use ($page) {
            $query->offset(($page-1) * 2);
        })->limit(2)->get();
        return [
            'comments' => $comments,
            'totalPage' => $totalPage
        ];
    }
}