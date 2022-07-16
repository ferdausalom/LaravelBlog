<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Flasher\Prime\FlasherInterface;

class CommentController extends Controller
{
    public function store(Post $post, FlasherInterface $flasher)
    {
        $this->commentReply($post);
        $flasher->addSuccess('Comment added successfully!');
        return redirect()->back();
    }

    public function replyStore(Post $post, FlasherInterface $flasher)
    {
        $this->commentReply($post);
        $flasher->addSuccess('Comment added successfully!');
        return redirect()->back();
    }

    protected function commentReply($post)
    {
        request()->validate([
            'body' => ['required']
        ]);
        $post->comments()->create([
            'body' => request('body'),
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'parent_id' => request('comment_id'),
        ]);
    }
}
