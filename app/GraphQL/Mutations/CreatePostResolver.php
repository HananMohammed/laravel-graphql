<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

final class CreatePostResolver {

    /**
     * @param null $_
     * @param array{} $args
     */
    public function __invoke( $_, array $args )
    {
        $post = Post::create( [
            'user_id' => $args[ 'user_id' ],
            'title'   => $args[ 'title' ],
            'body'    => $args[ 'body' ],
        ] );
        Log::info( 'send Email' );

        return $post;
    }
}
