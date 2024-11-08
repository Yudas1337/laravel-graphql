<?php

namespace App\GraphQL\Mutations\Category;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateCategory',
        'description' => 'Update a category',
    ];

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the category',
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the category',
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description of the category',
            ],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('Category');
    }

    public function resolve($root, $args): bool
    {
        $find = Category::query()->findOrFail($args['id']);

        $find->update($args);

        return $find;
    }
}
