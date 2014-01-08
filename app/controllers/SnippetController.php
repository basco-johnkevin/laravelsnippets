<?php

use LaraSnipp\Repo\Snippet\SnippetRepositoryInterface;
use LaraSnipp\Repo\User\UserRepositoryInterface;

class SnippetController extends BaseController {

    /**
     * Snippet repository
     *
     * @var \LaraSnipp\Repo\Snippet\SnippetRepositoryInterface
     */
    protected $snippet;

    /**
     * User repository
     *
     * @var \LaraSnipp\Repo\Snippet\UserRepositoryInterface
     */
    protected $user;

    public function __construct(SnippetRepositoryInterface $snippet, UserRepositoryInterface $user)
    {
        $this->snippet = $snippet;
        $this->user = $user;
    }

    /**
     * Show listing of snippets
     * GET /snippets
     */
    public function getIndex()
    {
        $page = Input::get('page', 1);

        // Candidate for config item
        $perPage = 10;

        $pagiData = $this->snippet->byPage($page, $perPage);
        $snippets = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);
        return View::make('snippets.index', compact('snippets'));
    }

    /**
     * Show an individual snippet
     * GET /snippets/{slug}
     */
    public function getShow($slug)
    {
        $snippet = $this->snippet->bySlug($slug);

        if ( ! $snippet)
        {
            return App::abort(404);
        }

        $user = Auth::user();
        $has_starred = ! empty( $user ) ? $user->hasStarred( $snippet->id ) : false;

        # increment hit count
        $snippet->incrementHits();

        return View::make('snippets.show', compact('snippet', 'has_starred'));
    }

    /**
     * Stars a snippet
     * GET /snippets/{slug}/star
     */
    public function starSnippet($slug)
    {
        $snippet = $this->snippet->bySlug($slug);
        $user = Auth::user();

        if ( empty( $user ) ) {
            return Redirect::route('snippet.getShow', array($slug))
                ->with(
                    'message',
                    sprintf(
                        'Only logged in users can star snippets. Please %s or %s.',
                        link_to_route( 'auth.getLogin', 'login' ),
                        link_to_route( 'auth.getSignup', 'signup' )
                    )
                );
        }

        $user->starSnippet( $snippet->id );

        return Redirect::route('snippet.getShow', array($slug));
    }

    /**
     * Unstars a snippet
     * GET /snippets/{slug}/unstar
     */
    public function unstarSnippet($slug)
    {
        $snippet = $this->snippet->bySlug($slug);
        $user = Auth::user();

        if ( empty( $user ) ) {
            return Redirect::route('snippet.getShow', array($slug))
                ->with(
                    'message',
                    sprintf(
                        'Only logged in users can unstar snippets. Please %s or %s.',
                        link_to_route( 'auth.getLogin', 'login' ),
                        link_to_route( 'auth.getSignup', 'signup' )
                    )
                );
        }

        $user->unStarSnippet( $snippet->id );

        return Redirect::route('snippet.getShow', array($slug));
    }

}