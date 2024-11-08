<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{

    protected $attributes = [
        'name' => 'Post',
        'description' => 'A Post',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the post',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of the post',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'The content of the post',
            ],
            'category' => [
                'type' => GraphQL::type('Category'),
                'description' => 'The category of the post',
                'resolve' => function ($user) {
                    return $user->user;
                }
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'The user of the post',
                'resolve' => function ($post) {
                    return $post->user;
                }
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The date the post was created',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The date the post was last updated'
            ],
        ];
    }
}
