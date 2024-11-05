<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Mutation;

class DeleteUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Delete a user',
    ];

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                "type" => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
            ],
        ];
    }

    public function type(): GraphQLType
    {
        return GraphQLType::boolean();
    }
    
    public function resolve($root, $args): bool
    {
        return User::query()->findOrFail($args['id'])->delete();
    }
}
