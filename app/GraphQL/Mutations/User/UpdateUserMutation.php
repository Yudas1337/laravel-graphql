<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateUserMutation extends Mutation
{

    protected $attributes = [
        'name' => 'updateUser',
        'description' => 'Update a user',
    ];

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the user',
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the user',
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'description' => 'The password of the user',
            ],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function resolve($root, $args): bool
    {
        return User::query()->findOrFail($args['id'])->update([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password'])
        ]);
    }
}
