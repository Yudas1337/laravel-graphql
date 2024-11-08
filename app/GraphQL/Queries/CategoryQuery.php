<?php

namespace App\GraphQL\Queries;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CategoryQuery extends Query
{
    protected $attributes = [
        'name' => 'categories',
        'description' => 'Get a category',
    ];

    public function type(): GraphQLType
    {
        return Type::listOf(GraphQL::type('Category'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'description' => 'The id of the category',
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'description' => 'The name of the category',
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
                'description' => 'The description of the category',
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Category::query()
                ->where('id', $args['id'])
                ->withCount('posts')
                ->with('posts')
                ->get();
        }

        if (isset($args['name'])) {
            return Category::query()
                ->where('name', $args['name'])
                ->withCount('posts')
                ->with('posts')
                ->get();
        }

        return Category::query()
            ->withCount('posts')
            ->with('posts')
            ->get();
    }
}
