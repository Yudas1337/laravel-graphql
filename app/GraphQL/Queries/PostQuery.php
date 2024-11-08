<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PostQuery extends Query
{

    protected $attributes = [
        'name' => 'posts',
        'description' => 'Get a post',
    ];

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

    public function type(): GraphQLType
    {
        return Type::listOf(GraphQL::type('Post'));
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Post::query()
                ->where('id', $args['id'])
                ->with('category')
                ->with('user')
                ->get();
        }

        if (isset($args['title'])) {
            return Post::query()
                ->where('title', $args['title'])
                ->with('category')
                ->with('user')
                ->get();
        }

        return Post::query()
            ->with('category')
            ->with('user')
            ->get();
    }
}
