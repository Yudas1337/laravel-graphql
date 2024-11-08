<?php

namespace App\GraphQL\Mutations\Category;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Database\QueryException;
use Rebing\GraphQL\Support\Mutation;

class DeleteCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteCategory',
        'description' => 'Delete a category',
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
        try {
            return Category::query()->findOrFail($args['id'])->delete();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return false;
            }
        }

        return true;

    }
}
