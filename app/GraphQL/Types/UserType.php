<?php

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A User',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the user',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the user',
            ],
            'email_verified_at' => [
                'type' => Type::string(),
                'description' => 'The date the user was verified'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The date the user was created',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The date the user was last updated'
            ]
        ];
    }
}
