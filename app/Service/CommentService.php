<?php

namespace App\Service;

use App\Models\Comment;

class CommentService
{
    public function __construct()
    {

    }

    public function getAllComments($blogId)
    {
        return Comment::where('blog_id', $blogId)->get();
    }
    public function countTotalByBlogId($blogId)
    {
        return Comment::where('blog_id', $blogId)->count();
    }


}
?>