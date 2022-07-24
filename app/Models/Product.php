<?php

namespace App\Models;

use App\Models\Traits\FormatPrices;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Attribute;
use App\Models\AttributeValue;

class Product extends Model
{
    use HasFactory, FormatPrices, SoftDeletes;

    public static $category_list = [
        'Arts',
        'Automotive',
        'Baby',
        'Beauty & Personal Care',
        'Books',
        "Boy's Fashion",
        'Computers',
        'Digital Music',
        'Electronics',
        "Girls' Fashion",
        'Health & Household',
        'Home & Kitchen',
        'Industrial & Scientific',
        'Luggage',
        "Men's Fashion",
        'Movies & TV',
        'Music, CDs & Vinyl',
        'Pet Supplies',
        'Software',
        'Sports & Outdoors',
        'Tools & Home Improvement',
        'Toys & Games',
        'Video Games',
        "Women's Fashion"        
    ];

    protected $fillable = [
        'price',
        'description',
        'name',
        'is_digital',
        'is_virtual',
        'is_madetoorder',
        'is_backorder',
        'is_trackingquantity',
        'category',
        'quantity',
        'product_images',
        'product_thumbnail',
        'slug',
        'status',
        'product_3dpreview',
        'product_attributes',
        'product_attribute_values',
    ];

    /*
    private static function getProductsAndMergeExtraProductsIfNotEnough(Collection $order_items)
    {
        $products = $order_items->map(fn($i) => $i->product);
        $order_items_quantity = $order_items->count();
        if($order_items_quantity < 100)
        {
            $diff = 100 - $order_items_quantity;

            $extra_products = Product::with('images')
                                        ->whereNotIn('id', $products->pluck('id'))
                                        ->limit($diff)
                                        ->get();

            $products = $products->merge($extra_products);
        }

        return $products;
    }
    */

    public static function getPriceInCents(float $price)
    {
        $price *= 100;
        return (int) $price;
    }
 /*
    public static function getTodaysDeals()
    {
        $order_items = OrderItem::select('id_product', DB::raw('sum(quantity) as total'))
                                ->where('created_at', '>=', now()->subDay())
                                ->groupBy('id_product')
                                ->orderBy('total', 'description')
                                ->with('product:id,name', 'product.images')
                                ->limit(100)
                                ->get();

        return Product::getProductsAndMergeExtraProductsIfNotEnough($order_items);
    }
    */

    public static function searchWithImages(string|null $search, string $category)
    {
        $q = Product::with('uploads');

        if($category != 'All')
        {
            $q = $q->whereHas('product_category', function ($query) use ($category){
                $query->where('category_name', $category);
            });
        }

        return $q->where('name', 'like', "%$search%")
                ->paginate(100);
    }

    public static function stringPriceToCents(string $price)
    {
        $price = str_replace('.', '', $price);
        $price = str_replace(',', '', $price);
        return (int) $price;
    }

    /*
    public function replaceImagesIfExist(array|null $images)
    {
        if($images)
        {
            $this->images()->delete();
            Storage::deleteDirectory($this->id);

            $images = collect($images)->map(fn($i) => [
                'path' => 'storage/'.$i->store($this->id)
            ]);

            $this->images()->createMany($images->toArray());
        }
    }

    public function storeImages(array $images)
    {
        $images = collect($images)->map(fn($i, $k) => [
            'path' => 'storage/'.$i->store($this->id)
        ]);
        
        $this->images()->createMany($images->toArray());
    }

    public function deleteImagesInStorage()
    {
        Storage::deleteDirectory($this->id);
    }
    
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_product')->orderBy('id', 'asc');
    }
    */

    public function tags()
    {
        return $this->hasMany(ProductTagsRelationship::class, 'id_product' , 'id');
    }

    public function product_category()
    {
        return $this->belongsTo(ProductsCategorie::class, 'category' , 'id');
    }

    public function uploads()
    {
        return $this->belongsTo(Upload::class, 'product_thumbnail' , 'id')->withDefault([
            'file_name' => "none.png",
            'id' => null
        ]);
    }

    public function variants()
    {
        return $this->hasMany(ProductsVariant::class, 'product_id' , 'id');
    }

    public function modelpreview()
    {
        return $this->belongsTo(Upload::class, 'product_3dpreview' , 'id')->withDefault([
            'file_name' => "none.png",
            'id' => null
        ]);
    }

    public function attribute() {
        $attributesIds = explode(',', $this->product_attributes);
        $attributes = Attribute::whereIn('id', $attributesIds)->get();

        return $attributes;
    }

    public function attributeValue($attributeId = 0) {
        $attributesValueIds = explode(',', $this->product_attribute_values);

        $model = AttributeValue::whereIn('id', $attributesValueIds);
        if ($attributeId != 0)
            $model = $model->where('attribute_id', $attributeId);
        
        $attributesValues = $model->get();

        return $attributesValues;
    }
}
