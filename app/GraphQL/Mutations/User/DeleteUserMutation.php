<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\QueryException;
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

    public function type(): Type
    {
        return Type::boolean();
    }

    public function resolve($root, $args): bool
    {
        try {
            return User::query()->findOrFail($args['id'])->delete();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return false;
            }
        }

        return true;
    }
}
