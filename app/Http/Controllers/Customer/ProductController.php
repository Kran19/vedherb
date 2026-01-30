<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Customer\ProductService;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productService;
    protected $cartHelper;

    public function __construct(ProductService $productService, \App\Helpers\CartHelper $cartHelper)
    {
        $this->productService = $productService;
        $this->cartHelper = $cartHelper;
    }

    /**
     * Product listing page
     */
    /**
     * Product listing page (Shop alias)
     */
    public function shop(Request $request)
    {
        return $this->listing($request, 'customer.products.shop');
    }

    /**
     * Blog page
     */
    public function blog()
    {
        return view('customer.products.blog');
    }

    /**
     * Product listing page
     */
    public function listing(Request $request, $viewName = 'customer.products.shop')
    {
        try {
            $perPage = $request->get('per_page', 12);
            $page = $request->get('page', 1);

            $filters = [
                'search' => $request->get('search') ?? $request->get('q', ''),
                'sort_by' => $request->get('sort_by', 'newest'),
                'min_price' => $request->get('min_price'),
                'max_price' => $request->get('max_price'),
                'category_id' => $request->get('category_id'),
                'brand_id' => $request->get('brand_id'),
                'attribute' => $request->get('attribute'),
                'attribute_value' => $request->get('attribute_value'),
                'specification' => $request->get('specification'),
                'specification_value' => $request->get('specification_value'),
                'in_stock' => $request->get('in_stock'),
                'is_featured' => $request->get('is_featured'),
                'is_new' => $request->get('is_new'),
                'is_bestseller' => $request->get('is_bestseller'),
            ];

            $products = $this->productService->getProducts($filters, $perPage, $page);
            $allFilters = $this->productService->getAllFilters();

            return view($viewName, [
                'products' => $products->items(),
                'paginator' => [
                    'current_page' => $products->currentPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'last_page' => $products->lastPage(),
                    'from' => $products->firstItem(),
                    'to' => $products->lastItem(),
                ],
                'filters' => $allFilters,
                'sortBy' => $filters['sort_by'],
                'search' => $filters['search'],
                'minPrice' => $filters['min_price'],
                'maxPrice' => $filters['max_price'],
                'categoryId' => $filters['category_id'],
                'brandId' => $filters['brand_id'],
                'inStock' => $filters['in_stock'],
                'isFeatured' => $filters['is_featured'],
                'isNew' => $filters['is_new'],
                'isBestseller' => $filters['is_bestseller'],
                'title' => 'All Products - Ved Herbs & Ayurveda',
                'cartVariantIds' => $this->cartHelper->getCartVariantIds(),
            ]);

        } catch (\Exception $e) {
            Log::error('Product listing error: ' . $e->getMessage());
            return view($viewName, [
                'products' => [],
                'paginator' => [],
                'filters' => $this->productService->getAllFilters(),
                'error' => 'Failed to load products. Please try again.',
                'title' => 'Products - Error',
            ]);
        }
    }

    /**
     * Category products page
     */
    public function category($slug, Request $request)
    {
        try {
            $category = $this->productService->getCategoryBySlug($slug);

            // if (!$category) {
            //     return redirect()->route('customer.products.list')
            //         ->with('error', 'Category not found.');
            // }

            $perPage = $request->get('per_page', 12);
            $page = $request->get('page', 1);

            $filters = [
                'category_id' => $category->id,
                'search' => $request->get('search') ?? $request->get('q', ''),
                'sort_by' => $request->get('sort_by', 'newest'),
                'min_price' => $request->get('min_price'),
                'max_price' => $request->get('max_price'),
                'brand_id' => $request->get('brand_id'),
                'attribute' => $request->get('attribute'),
                'attribute_value' => $request->get('attribute_value'),
                'specification' => $request->get('specification'),
                'specification_value' => $request->get('specification_value'),
                'in_stock' => $request->get('in_stock'),
                'is_featured' => $request->get('is_featured'),
                'is_new' => $request->get('is_new'),
                'is_bestseller' => $request->get('is_bestseller'),
            ];

            $products = $this->productService->getProducts($filters, $perPage, $page);
            $categoryFilters = $this->productService->getCategoryFilters($category->id);
            $childCategories = $this->productService->getChildCategories($category->id);
            $relatedCategories = $this->productService->getRelatedCategories($category->id);

            return view('customer.products.category', [
                'category' => $category,
                'products' => $products->items(),
                'paginator' => [
                    'current_page' => $products->currentPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'last_page' => $products->lastPage(),
                    'from' => $products->firstItem(),
                    'to' => $products->lastItem(),
                ],
                'filters' => $categoryFilters,
                'childCategories' => $childCategories,
                'relatedCategories' => $relatedCategories,
                'sortBy' => $filters['sort_by'],
                'search' => $filters['search'],
                'minPrice' => $filters['min_price'],
                'maxPrice' => $filters['max_price'],
                'brandId' => $filters['brand_id'],
                'inStock' => $filters['in_stock'],
                'isFeatured' => $filters['is_featured'],
                'isNew' => $filters['is_new'],
                'isBestseller' => $filters['is_bestseller'],
                'title' => $category->name . ' - Ved Herbs & Ayurveda',
                'meta_description' => $category->meta_description ?? $category->description,
                'cartVariantIds' => $this->cartHelper->getCartVariantIds(),
            ]);

        } catch (\Exception $e) {
            Log::error('Category page error: ' . $e->getMessage());
            return redirect()->route('customer.products.list')
                ->with('error', 'Failed to load category. Please try again.');
        }
    }

    /**
     * Product details page
     */
    public function details($slug)
    {
        try {
            $product = $this->productService->getProductBySlug($slug);

            if (!$product) {
                return redirect()->route('customer.products.list')
                    ->with('error', 'Product not found.');
            }

            $relatedProducts = $this->productService->getRelatedProducts($product['id'], 4);

            // Fetch reviews
            $reviews = \App\Models\Review::where('product_id', $product['id'])
                ->where('status', true)
                ->latest()
                ->get();

            $wishlistVariantIds = [];
            if (\Illuminate\Support\Facades\Auth::guard('customer')->check()) {
                $wishlist = \App\Models\Wishlist::where('customer_id', \Illuminate\Support\Facades\Auth::guard('customer')->id())->first();
                if ($wishlist) {
                    $wishlistVariantIds = $wishlist->items()->pluck('product_variant_id')->toArray();
                }
            }

            return view('customer.products.details', [
                'product' => $product,
                'relatedProducts' => $relatedProducts,
                'reviews' => $reviews,
                'title' => $product['name'] . ' - APIQO Fashion Jewelry',
                'meta_title' => $product['meta_title'] ?? $product['name'],
                'meta_description' => $product['meta_description'] ?? $product['short_description'],
                'meta_keywords' => $product['meta_keywords'] ?? null,
                'cartVariantIds' => $this->cartHelper->getCartVariantIds(),
                'wishlistVariantIds' => $wishlistVariantIds,
            ]);

        } catch (\Exception $e) {
            Log::error('Product details error: ' . $e->getMessage());
            return redirect()->route('customer.products.list')
                ->with('error', 'Product not found.');
        }
    }

    /**
     * Search products
     */
    public function search(Request $request)
    {
        try {
            $searchQuery = $request->get('q') ?? $request->get('search', '');

            if (empty($searchQuery)) {
                return redirect()->route('customer.products.shop');
            }

            $perPage = $request->get('per_page', 12);
            $page = $request->get('page', 1);

            $filters = [
                'search' => $searchQuery,
                'sort_by' => $request->get('sort_by', 'newest'),
                'min_price' => $request->get('min_price'),
                'max_price' => $request->get('max_price'),
                'category_id' => $request->get('category_id'),
                'brand_id' => $request->get('brand_id'),
                'attribute' => $request->get('attribute'),
                'attribute_value' => $request->get('attribute_value'),
                'specification' => $request->get('specification'),
                'specification_value' => $request->get('specification_value'),
                'in_stock' => $request->get('in_stock'),
                'is_featured' => $request->get('is_featured'),
                'is_new' => $request->get('is_new'),
                'is_bestseller' => $request->get('is_bestseller'),
            ];

            $products = $this->productService->searchProducts($searchQuery, $filters, $perPage, $page);
            $allFilters = $this->productService->getAllFilters();

            return view('customer.products.search', [
                'search' => $searchQuery,
                'products' => $products->items(),
                'paginator' => [
                    'current_page' => $products->currentPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'last_page' => $products->lastPage(),
                    'from' => $products->firstItem(),
                    'to' => $products->lastItem(),
                ],
                'filters' => $allFilters,
                'sortBy' => $filters['sort_by'],
                'minPrice' => $filters['min_price'],
                'maxPrice' => $filters['max_price'],
                'categoryId' => $filters['category_id'],
                'brandId' => $filters['brand_id'],
                'inStock' => $filters['in_stock'],
                'isFeatured' => $filters['is_featured'],
                'isNew' => $filters['is_new'],
                'isBestseller' => $filters['is_bestseller'],
                'title' => 'Search: ' . $searchQuery . ' - Ved Herbs & Ayurveda',
                'meta_description' => 'Search results for ' . $searchQuery . ' in Ved Herbs & Ayurveda',
                'cartVariantIds' => $this->cartHelper->getCartVariantIds(),
            ]);

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return view('customer.products.search', [
                'searchQuery' => $request->get('q', ''),
                'products' => [],
                'paginator' => [],
                'filters' => $this->productService->getAllFilters(),
                'error' => 'Search failed. Please try again.',
                'title' => 'Search Error',
            ]);
        }
    }

    /**
     * Quick view product
     */
    public function quickView($slug)
    {
        try {
            $product = $this->productService->getProductBySlug($slug);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $product,
                'html' => view('customer.products.partials.quick-view', ['product' => $product])->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Quick view error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
    }
}
