<?php

namespace App\GraphQL\Mutations\Post;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreatePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createPost',
        'description' => 'Create a post',
    ];

    public function args(): array
    {
        return [
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

    public function type(): GraphQLType
    {
        return GraphQL::type('Post');
    }

    public function resolve($root, $args)
    {
        return Post::query()->create([
            'title' => $args['title'],
            'content' => $args['content'],
            'category_id' => $args['category'],
            'user_id' => $args['user'],
        ]);
    }
}
