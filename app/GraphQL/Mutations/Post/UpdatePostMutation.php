<?php

namespace App\GraphQL\Mutations\Post;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdatePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updatePost',
        'description' => 'Update a post',
    ];

    public function type(): GraphQLType
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'description' => 'The id of the post',
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
                'description' => 'The title of the post',
            ],
            'content' => [
                'name' => 'content',
                'type' => Type::string(),
                'description' => 'The content of the post',
            ],
            'category' => [
                'name' => 'category',
                'type' => Type::string(),
                'description' => 'The category of the post',
            ],
            'user' => [
                'name' => 'user',
                'type' => Type::string(),
                'description' => 'The user of the post',
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $post = Post::query()->findOrFail($args['id']);

        $post->update([
            'title' => $args['title'],
            'content' => $args['content'],
            'category_id' => $args['category'],
            'user_id' => $args['user']
        ]);

        return $post;
    }
}
