<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    use ApiResponses ;
    public function addPost(PostRequest $request)
    {
        $data = $request->validated();
        $post = Post::query()->create($data);
        if ($post) {
            return $this->success(message: 'Done send post');
        }
        return $this->failure('Please try again');
    }
    public function getPosts(Request $request)
    {
            $posts = Post::where('user_id', auth()->id())
                ->paginate(10);
            return $this->success(PostResource::collection($posts), $posts, message: 'User Post List');
    }
    public function getTopPosts(Request $request)
    {
            $posts = Post::query()->latest()->paginate(10);
            return $this->success(PostResource::collection($posts), $posts, message: 'Top Posts List');
    }
    public function addReview(Request $request)
    {
        $data = $request->validate([
            'user_id' =>  ['required', 'integer', Rule::exists('users', 'id')],
            'post_id' =>  ['required', 'integer', Rule::exists('posts', 'id')],
            'rate' => ['required', 'integer', Rule::in([1,2,3,4,5])],
            'body' => ['required', 'string', 'min:2', 'max:500'],
        ]);
        $review = Review::query()->create($data);
        if ($review) {
            return $this->success(message: 'Done send review');
        }
        return $this->failure('Please try again');
    }

}
