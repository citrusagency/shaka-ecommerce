<?php

namespace Webkul\Shop\Http\Controllers;

use Webkul\Attribute\Models\Attribute;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Category\Models\Category;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Product\Repositories\ProductFlatRepository;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Category\Repositories\CategoryRepository  $categoryRepository
     * @param  \Webkul\Product\Repositories\ProductFlatRepository  $productFlatRepository
     * @return void
     */
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected ProductFlatRepository $productFlatRepository,
        protected AttributeRepository $attributeRepository

    )
    {
        parent::__construct();
    }

    /**
     * Get filter attributes for product.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFilterAttributes($categoryId = 2)
    {
        $category = $this->categoryRepository->findOrFail($categoryId);

        if (empty($filterAttributes = $category->filterableAttributes)) {
            $filterAttributes = $this->attributeRepository->getFilterAttributes();
        }
        $attributes = Attribute::query()->where('code','=', 'material')->with('options')->get();
        // get all categories with their children
        $categories = Category::query()->whereNull('parent_id')->with('children')->get();

        // Order filter attributes by name asc using php array functions
        $array = $filterAttributes->toArray();
        usort($array, fn($a, $b) => $a['name'] <=> $b['name']);




        return response()->json([
            'filter_attributes' => $array,
            'categories' => $categories,
            'attributes' => $attributes
        ]);
    }

    /**
     * Get category product maximum price.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryProductMaximumPrice($categoryId = 2)
    {
        $category = $this->categoryRepository->findOrFail($categoryId);

        $maxPrice = $this->productFlatRepository->handleCategoryProductMaximumPrice($category);

        return response()->json([
            'max_price' => $maxPrice,
        ]);
    }
}
