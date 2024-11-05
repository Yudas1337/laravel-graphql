<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
        'description' => 'Get a user',
    ];

    public function type(): GraphQLType
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'description' => 'The id of the user',
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'description' => 'The name of the user',
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
                'description' => 'The email of the user',
            ],
            'email_verified_at' => [
                'type' => Type::string(),
                'description' => 'The date the user was verified'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The date the user was created'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The date the user was last updated'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return User::query()->where('id', $args['id'])->get();
        }

        if (isset($args['name'])) {
            return User::query()->where('name', $args['name'])->get();
        }

        if (isset($args['email'])) {
            return User::query()->where('email', $args['email'])->get();
        }

        return User::all();


    }
}
