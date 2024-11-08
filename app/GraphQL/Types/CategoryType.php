<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'A Category',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the category',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the category',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of the category',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The date the category was created',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The date the category was last updated'
            ]
        ];
    }
}
