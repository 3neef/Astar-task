<?php


namespace App\Collections;


use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CategoriesCollection
{
    public static function collection (Request $request) {

        $defaultSort = '-created_at';

        $allowedFilters = [
            'id',
            'name',
            'created_at',
            'updated_at',
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];


        $perPage = $request->limit  ? $request->limit : 10;

        return QueryBuilder::for(Category::class)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }

}
