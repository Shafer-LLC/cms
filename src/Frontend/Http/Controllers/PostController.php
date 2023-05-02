<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\Frontend\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Dply\Backend\Events\PostViewed;
use Dply\Backend\Http\Resources\CommentResource;
use Dply\Backend\Http\Resources\PostResource;
use Dply\Backend\Http\Resources\PostResourceCollection;
use Dply\Backend\Models\Comment;
use Dply\Backend\Models\Post;
use Dply\Backend\Repositories\PostRepository;
use Dply\CMS\Facades\Facades;
use Dply\CMS\Facades\HookAction;
use Dply\CMS\Http\Controllers\FrontendController;
use Dply\Frontend\Http\Requests\CommentRequest;

class PostController extends FrontendController
{
    public function __construct(protected PostRepository $postRepository)
    {
    }

    public function index(...$slug)
    {
        if (count($slug) > 1) {
            return $this->detail(...$slug);
        }

        $title = get_config('title');
        $posts = $this->postRepository->frontendListPaginate(get_config('posts_per_page', 12));

        $posts->appends(request()->query());

        $page = PostResourceCollection::make($posts)
            ->response()
            ->getData(true);

        return $this->view(
            'theme::index',
            compact(
                'page',
                'title'
            )
        );
    }

    public function detail(...$slug)
    {
        do_action("frontend.post_type.detail", $slug);

        $base = Arr::get($slug, 0);
        $postSlug = $this->getPostSlug($slug);
        $permalink = $this->getPermalinks($base);

        $postType = HookAction::getPostTypes($permalink->get('post_type'));

        do_action(
            "frontend.post_type.{$permalink->get('post_type')}.detail",
            $slug,
            $postSlug,
            $permalink
        );

        /**
         * @var Post $postModel
         */
        $postModel = $this->postRepository->findBySlug($postSlug, false);
        if (empty($postModel) && count($slug) > 2) {
            $postModel = $this->postRepository->findBySlug($slug[1]);
        }

        Facades::$isPostPage = true;

        Facades::$post = $postModel;

        event(new PostViewed($postModel));

        $title = $postModel->getTitle();
        $description = $postModel->description;
        $type = $postModel->getPostType('singular');
        $template = get_name_template_part($type, 'single');

        $post = (new PostResource($postModel))->toArray(request());

        $rows = Comment::with(['user'])
            ->cacheFor(config('juzaweb.performance.query_cache.lifetime'))
            ->where(['object_id' => $post['id']])
            ->whereApproved()
            ->paginate(10);

        $comments = CommentResource::collection($rows)->response()->getData(true);
        $image = $postModel->thumbnail ? upload_url($postModel->thumbnail) : null;

        $data = apply_filters(
            "frontend.post_type.detail.data",
            compact(
                'title',
                'post',
                'description',
                'comments',
                'slug',
                'image'
            ),
            $postModel
        );

        $data = apply_filters(
            "frontend.post_type.{$postType->get('key')}.detail.data",
            $data,
            $postModel
        );

        return $this->view(
            "theme::template-parts.{$template}",
            $data
        );
    }

    public function comment(CommentRequest $request, $slug): JsonResponse|RedirectResponse
    {
        $slug = explode('/', $slug);
        $base = Arr::get($slug, 0);
        $slug = $this->getPostSlug($slug);

        $permalink = $this->getPermalinks($base);
        $postType = HookAction::getPostTypes($permalink->get('post_type'));

        if (!in_array('comment', $postType->get('supports', []))) {
            return $this->error(
                [
                    'message' => __('Comments is not supported.'),
                ]
            );
        }

        $post = $this->postRepository->findBySlug($slug);
        $data = $request->all();
        $data['object_type'] = $permalink->get('post_type');
        $data['user_id'] = Auth::id();

        $comment = $post->comments()->create($data);

        do_action('post_type.comment.saved', $comment, $post);

        return $this->success(trans('cms::app.comment_success'));
    }

    private function getPostSlug(array $slug): string
    {
        unset($slug[0]);

        return implode('/', $slug);
    }
}
