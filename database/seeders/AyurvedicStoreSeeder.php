<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AyurvedicStoreSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Clear existing data (carefully)
        $this->truncateTables();

        // Seed in correct order
        $this->seedMediaReferences();
        $this->seedBrands();
        $this->seedCategories();
        $this->seedTags();
        $this->seedSpecificationGroups();
        $this->seedSpecifications();
        $this->seedAttributes();
        $this->seedAttributeValues();
        $this->seedTaxClasses();
        $this->seedSpecificationValues();
        $this->seedSpecGroupSpecs();
        $this->seedCategorySpecGroups();
        $this->seedCategoryAttributes();
        $this->seedProductsAndVariants();
        $this->seedProductRelationships();
        $this->call(SettingsSeeder::class);

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    private function truncateTables()
    {
        // Truncate in reverse order of dependencies
        $tables = [
            'category_product',
            'product_tags',
            'related_products',
            'cross_sell_products',
            'upsell_products',
            'variant_attributes',
            'product_specifications',
            'variant_images',
            'product_variants',
            'products',
            'category_spec_groups',
            'spec_group_specs',
            'specification_values',
            'category_attributes',
            'attribute_values',
            'attributes',
            'specifications',
            'specification_groups',
            'tags',
            'categories',
            'brands',
            'category_hierarchies',
            'tax_classes',
        ];

        foreach ($tables as $table) {
            if (DB::getSchemaBuilder()->hasTable($table)) {
                DB::table($table)->truncate();
            }
        }
    }

    private function seedMediaReferences()
    {
        // Media IDs 1-20 exist as you mentioned
        // They will be referenced in variant_images
    }

    private function seedBrands()
    {
        $brands = [
            [
                'name' => 'Ved Herbs & Ayurveda',
                'slug' => 'ved-herbs-ayurveda',
                'description' => 'Trusted authentic Ayurvedic wellness products made with ancient wisdom',
                'logo_id' => 1,
                'status' => 1,
                'sort_order' => 1,
                'meta_title' => 'Ved Herbs & Ayurveda - Authentic Ayurvedic Products',
                'meta_description' => 'Premium Ayurvedic formulations for holistic wellness and vitality',
                'meta_keywords' => 'ayurveda, herbal products, natural wellness, ved herbs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('brands')->insert($brands);
    }

    private function seedCategories()
    {
        $categories = [
            [
                'parent_id' => null,
                'name' => 'Men\'s Wellness',
                'slug' => 'mens-wellness',
                'description' => 'Ayurvedic formulations for men\'s health, stamina, and vitality',
                'status' => 1,
                'featured' => 1,
                'show_in_nav' => 1,
                'sort_order' => 1,
                'image_id' => 4,
                'meta_title' => 'Men\'s Ayurvedic Products - Stamina & Vitality',
                'meta_description' => 'Natural Ayurvedic products for men\'s health, performance, and wellness',
                'meta_keywords' => 'mens health, stamina, vitality, performance enhancers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => null,
                'name' => 'Women\'s Wellness',
                'slug' => 'womens-wellness',
                'description' => 'Ayurvedic products for women\'s health, hormonal balance, and vitality',
                'status' => 1,
                'featured' => 1,
                'show_in_nav' => 1,
                'sort_order' => 2,
                'image_id' => 5,
                'meta_title' => 'Women\'s Ayurvedic Products - Hormonal Balance',
                'meta_description' => 'Natural Ayurvedic formulations for women\'s wellness and hormonal health',
                'meta_keywords' => 'womens health, hormonal balance, feminine wellness',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => null,
                'name' => 'Digestive Health',
                'slug' => 'digestive-health',
                'description' => 'Ayurvedic remedies for digestion, constipation, and gut health',
                'status' => 1,
                'featured' => 1,
                'show_in_nav' => 1,
                'sort_order' => 3,
                'image_id' => 6,
                'meta_title' => 'Ayurvedic Digestive Products - Gut Health',
                'meta_description' => 'Natural digestive aids, constipation relief, and gut wellness products',
                'meta_keywords' => 'digestive health, constipation relief, gut health, digestion',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => null,
                'name' => 'Herbal Pastes',
                'slug' => 'herbal-pastes',
                'description' => 'Traditional Ayurvedic herbal pastes for various health benefits',
                'status' => 1,
                'featured' => 1,
                'show_in_nav' => 1,
                'sort_order' => 4,
                'image_id' => 7,
                'meta_title' => 'Ayurvedic Herbal Pastes - Traditional Formulations',
                'meta_description' => 'Authentic Ayurvedic herbal pastes for vitality and wellness',
                'meta_keywords' => 'herbal pastes, ayurvedic pastes, traditional formulations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => null,
                'name' => 'External Applications',
                'slug' => 'external-applications',
                'description' => 'Ayurvedic oils, gels, and external applications for wellness',
                'status' => 1,
                'featured' => 1,
                'show_in_nav' => 1,
                'sort_order' => 5,
                'image_id' => 8,
                'meta_title' => 'Ayurvedic Oils & Gels - External Applications',
                'meta_description' => 'Natural Ayurvedic oils and gels for external use and massage',
                'meta_keywords' => 'ayurvedic oils, massage oils, herbal gels, external applications',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => null,
                'name' => 'Oral Supplements',
                'slug' => 'oral-supplements',
                'description' => 'Ayurvedic pills, capsules, and oral supplements for health',
                'status' => 1,
                'featured' => 1,
                'show_in_nav' => 1,
                'sort_order' => 6,
                'image_id' => 9,
                'meta_title' => 'Ayurvedic Pills & Supplements - Oral Health Products',
                'meta_description' => 'Natural Ayurvedic pills and supplements for internal wellness',
                'meta_keywords' => 'ayurvedic pills, oral supplements, capsules, tablets',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);

        // Create category hierarchies
        $this->createCategoryHierarchies();
    }

    private function createCategoryHierarchies()
    {
        $categories = DB::table('categories')->get();
        $hierarchies = [];

        foreach ($categories as $category) {
            // Self reference only
            $hierarchies[] = [
                'ancestor_id' => $category->id,
                'descendant_id' => $category->id,
                'depth' => 0,
            ];
        }

        DB::table('category_hierarchies')->insert($hierarchies);
    }

    private function seedTags()
    {
        $tags = [
            ['name' => '100% Natural', 'slug' => '100-natural', 'status' => 1],
            ['name' => 'Ayurvedic', 'slug' => 'ayurvedic', 'status' => 1],
            ['name' => 'Herbal', 'slug' => 'herbal', 'status' => 1],
            ['name' => 'Organic', 'slug' => 'organic', 'status' => 1],
            ['name' => 'No Side Effects', 'slug' => 'no-side-effects', 'status' => 1],
            ['name' => 'Traditional', 'slug' => 'traditional', 'status' => 1],
            ['name' => 'Wellness', 'slug' => 'wellness', 'status' => 1],
            ['name' => 'Vitality', 'slug' => 'vitality', 'status' => 1],
            ['name' => 'Stamina', 'slug' => 'stamina', 'status' => 1],
            ['name' => 'Hormonal Balance', 'slug' => 'hormonal-balance', 'status' => 1],
            ['name' => 'Digestive Health', 'slug' => 'digestive-health', 'status' => 1],
            ['name' => 'Immunity Booster', 'slug' => 'immunity-booster', 'status' => 1],
            ['name' => 'Stress Relief', 'slug' => 'stress-relief', 'status' => 1],
            ['name' => 'Energy Booster', 'slug' => 'energy-booster', 'status' => 1],
            ['name' => 'Rejuvenating', 'slug' => 'rejuvenating', 'status' => 1],
            ['name' => 'Men\'s Health', 'slug' => 'mens-health', 'status' => 1],
            ['name' => 'Women\'s Health', 'slug' => 'womens-health', 'status' => 1],
            ['name' => 'Performance', 'slug' => 'performance', 'status' => 1],
            ['name' => 'Confidence', 'slug' => 'confidence', 'status' => 1],
            ['name' => 'Detox', 'slug' => 'detox', 'status' => 1],
        ];

        foreach ($tags as $tag) {
            $tag['created_at'] = now();
            $tag['updated_at'] = now();
            DB::table('tags')->insert($tag);
        }
    }

    private function seedSpecificationGroups()
    {
        $groups = [
            ['name' => 'Product Information', 'sort_order' => 1, 'status' => 1],
            ['name' => 'Ingredients & Composition', 'sort_order' => 2, 'status' => 1],
            ['name' => 'Usage Instructions', 'sort_order' => 3, 'status' => 1],
            ['name' => 'Safety & Precautions', 'sort_order' => 4, 'status' => 1],
            ['name' => 'Storage & Shelf Life', 'sort_order' => 5, 'status' => 1],
        ];

        foreach ($groups as $group) {
            $group['created_at'] = now();
            $group['updated_at'] = now();
            DB::table('specification_groups')->insert($group);
        }
    }

    private function seedSpecifications()
    {
        $specifications = [
            [
                'name' => 'Product Form',
                'code' => 'product_form',
                'input_type' => 'select',
                'is_required' => 1,
                'is_filterable' => 1,
                'sort_order' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Net Weight/Quantity',
                'code' => 'net_weight',
                'input_type' => 'text',
                'is_required' => 1,
                'is_filterable' => 0,
                'sort_order' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shelf Life',
                'code' => 'shelf_life',
                'input_type' => 'text',
                'is_required' => 1,
                'is_filterable' => 0,
                'sort_order' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Main Ingredients',
                'code' => 'main_ingredients',
                'input_type' => 'textarea',
                'is_required' => 1,
                'is_filterable' => 0,
                'sort_order' => 4,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Key Benefits',
                'code' => 'key_benefits',
                'input_type' => 'textarea',
                'is_required' => 1,
                'is_filterable' => 0,
                'sort_order' => 5,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Usage Type',
                'code' => 'usage_type',
                'input_type' => 'select',
                'is_required' => 1,
                'is_filterable' => 1,
                'sort_order' => 6,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dosage',
                'code' => 'dosage',
                'input_type' => 'textarea',
                'is_required' => 1,
                'is_filterable' => 0,
                'sort_order' => 7,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Recommended Duration',
                'code' => 'recommended_duration',
                'input_type' => 'text',
                'is_required' => 0,
                'is_filterable' => 0,
                'sort_order' => 8,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Age Restriction',
                'code' => 'age_restriction',
                'input_type' => 'select',
                'is_required' => 1,
                'is_filterable' => 1,
                'sort_order' => 9,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Safety Warnings',
                'code' => 'safety_warnings',
                'input_type' => 'textarea',
                'is_required' => 1,
                'is_filterable' => 0,
                'sort_order' => 10,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Storage Instructions',
                'code' => 'storage_instructions',
                'input_type' => 'textarea',
                'is_required' => 1,
                'is_filterable' => 0,
                'sort_order' => 11,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manufacturing Standards',
                'code' => 'manufacturing_standards',
                'input_type' => 'select',
                'is_required' => 1,
                'is_filterable' => 1,
                'sort_order' => 12,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dietary Compatibility',
                'code' => 'dietary_compatibility',
                'input_type' => 'multiselect',
                'is_required' => 0,
                'is_filterable' => 1,
                'sort_order' => 13,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Time of Use',
                'code' => 'time_of_use',
                'input_type' => 'select',
                'is_required' => 0,
                'is_filterable' => 1,
                'sort_order' => 14,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('specifications')->insert($specifications);
    }

    private function seedSpecificationValues()
    {
        $specs = DB::table('specifications')->pluck('id', 'code');
        $values = [];

        // Product Form values
        $values[] = ['specification_id' => $specs['product_form'], 'value' => 'Herbal Paste', 'sort_order' => 1, 'status' => 1];
        $values[] = ['specification_id' => $specs['product_form'], 'value' => 'Oil', 'sort_order' => 2, 'status' => 1];
        $values[] = ['specification_id' => $specs['product_form'], 'value' => 'Gel', 'sort_order' => 3, 'status' => 1];
        $values[] = ['specification_id' => $specs['product_form'], 'value' => 'Powder', 'sort_order' => 4, 'status' => 1];
        $values[] = ['specification_id' => $specs['product_form'], 'value' => 'Pills/Capsules', 'sort_order' => 5, 'status' => 1];
        $values[] = ['specification_id' => $specs['product_form'], 'value' => 'Chyawanprash', 'sort_order' => 6, 'status' => 1];

        // Usage Type values
        $values[] = ['specification_id' => $specs['usage_type'], 'value' => 'Oral', 'sort_order' => 1, 'status' => 1];
        $values[] = ['specification_id' => $specs['usage_type'], 'value' => 'External', 'sort_order' => 2, 'status' => 1];
        $values[] = ['specification_id' => $specs['usage_type'], 'value' => 'Both', 'sort_order' => 3, 'status' => 1];

        // Age Restriction values
        $values[] = ['specification_id' => $specs['age_restriction'], 'value' => '18+ Years', 'sort_order' => 1, 'status' => 1];
        $values[] = ['specification_id' => $specs['age_restriction'], 'value' => '21+ Years', 'sort_order' => 2, 'status' => 1];
        $values[] = ['specification_id' => $specs['age_restriction'], 'value' => 'Adults Only', 'sort_order' => 3, 'status' => 1];
        $values[] = ['specification_id' => $specs['age_restriction'], 'value' => 'No Restriction', 'sort_order' => 4, 'status' => 1];

        // Manufacturing Standards values
        $values[] = ['specification_id' => $specs['manufacturing_standards'], 'value' => 'GMP Certified', 'sort_order' => 1, 'status' => 1];
        $values[] = ['specification_id' => $specs['manufacturing_standards'], 'value' => 'ISO Certified', 'sort_order' => 2, 'status' => 1];
        $values[] = ['specification_id' => $specs['manufacturing_standards'], 'value' => 'FSSAI Approved', 'sort_order' => 3, 'status' => 1];
        $values[] = ['specification_id' => $specs['manufacturing_standards'], 'value' => 'Ayush Certified', 'sort_order' => 4, 'status' => 1];

        // Dietary Compatibility values
        $values[] = ['specification_id' => $specs['dietary_compatibility'], 'value' => 'Vegetarian', 'sort_order' => 1, 'status' => 1];
        $values[] = ['specification_id' => $specs['dietary_compatibility'], 'value' => 'Vegan', 'sort_order' => 2, 'status' => 1];
        $values[] = ['specification_id' => $specs['dietary_compatibility'], 'value' => 'Lactose Free', 'sort_order' => 3, 'status' => 1];
        $values[] = ['specification_id' => $specs['dietary_compatibility'], 'value' => 'Gluten Free', 'sort_order' => 4, 'status' => 1];

        // Time of Use values
        $values[] = ['specification_id' => $specs['time_of_use'], 'value' => 'Morning', 'sort_order' => 1, 'status' => 1];
        $values[] = ['specification_id' => $specs['time_of_use'], 'value' => 'Evening', 'sort_order' => 2, 'status' => 1];
        $values[] = ['specification_id' => $specs['time_of_use'], 'value' => 'Bedtime', 'sort_order' => 3, 'status' => 1];
        $values[] = ['specification_id' => $specs['time_of_use'], 'value' => 'After Meals', 'sort_order' => 4, 'status' => 1];
        $values[] = ['specification_id' => $specs['time_of_use'], 'value' => 'Before Meals', 'sort_order' => 5, 'status' => 1];

        foreach ($values as $value) {
            $value['created_at'] = now();
            $value['updated_at'] = now();
            DB::table('specification_values')->insert($value);
        }
    }

    private function seedSpecGroupSpecs()
    {
        $groups = DB::table('specification_groups')->pluck('id', 'name');
        $specs = DB::table('specifications')->pluck('id', 'code');

        $groupSpecs = [
            // Product Information group
            ['spec_group_id' => $groups['Product Information'], 'specification_id' => $specs['product_form'], 'sort_order' => 1],
            ['spec_group_id' => $groups['Product Information'], 'specification_id' => $specs['net_weight'], 'sort_order' => 2],
            ['spec_group_id' => $groups['Product Information'], 'specification_id' => $specs['shelf_life'], 'sort_order' => 3],
            ['spec_group_id' => $groups['Product Information'], 'specification_id' => $specs['manufacturing_standards'], 'sort_order' => 4],

            // Ingredients & Composition group
            ['spec_group_id' => $groups['Ingredients & Composition'], 'specification_id' => $specs['main_ingredients'], 'sort_order' => 1],
            ['spec_group_id' => $groups['Ingredients & Composition'], 'specification_id' => $specs['key_benefits'], 'sort_order' => 2],
            ['spec_group_id' => $groups['Ingredients & Composition'], 'specification_id' => $specs['dietary_compatibility'], 'sort_order' => 3],

            // Usage Instructions group
            ['spec_group_id' => $groups['Usage Instructions'], 'specification_id' => $specs['usage_type'], 'sort_order' => 1],
            ['spec_group_id' => $groups['Usage Instructions'], 'specification_id' => $specs['dosage'], 'sort_order' => 2],
            ['spec_group_id' => $groups['Usage Instructions'], 'specification_id' => $specs['recommended_duration'], 'sort_order' => 3],
            ['spec_group_id' => $groups['Usage Instructions'], 'specification_id' => $specs['time_of_use'], 'sort_order' => 4],

            // Safety & Precautions group
            ['spec_group_id' => $groups['Safety & Precautions'], 'specification_id' => $specs['age_restriction'], 'sort_order' => 1],
            ['spec_group_id' => $groups['Safety & Precautions'], 'specification_id' => $specs['safety_warnings'], 'sort_order' => 2],

            // Storage & Shelf Life group
            ['spec_group_id' => $groups['Storage & Shelf Life'], 'specification_id' => $specs['storage_instructions'], 'sort_order' => 1],
        ];

        foreach ($groupSpecs as $groupSpec) {
            $groupSpec['created_at'] = now();
            $groupSpec['updated_at'] = now();
            DB::table('spec_group_specs')->insert($groupSpec);
        }
    }

    private function seedCategorySpecGroups()
    {
        $categories = DB::table('categories')->pluck('id', 'slug');
        $groups = DB::table('specification_groups')->pluck('id', 'name');

        $categoryGroups = [];

        foreach ($categories as $slug => $categoryId) {
            foreach ($groups as $groupName => $groupId) {
                $categoryGroups[] = [
                    'category_id' => $categoryId,
                    'spec_group_id' => $groupId,
                    'sort_order' => array_search($groupName, array_keys($groups->toArray())) + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('category_spec_groups')->insert($categoryGroups);
    }

    private function seedAttributes()
    {
        $attributes = [
            [
                'name' => 'Package Size',
                'code' => 'package_size',
                'type' => 'select',
                'is_variant' => 1,
                'is_filterable' => 1,
                'sort_order' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Flavor',
                'code' => 'flavor',
                'type' => 'select',
                'is_variant' => 1,
                'is_filterable' => 1,
                'sort_order' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Duration',
                'code' => 'duration',
                'type' => 'select',
                'is_variant' => 1,
                'is_filterable' => 1,
                'sort_order' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('attributes')->insert($attributes);
    }

    private function seedAttributeValues()
    {
        $attributes = DB::table('attributes')->pluck('id', 'code');
        $values = [];

        // Package Size attribute values
        $packageSizes = [
            ['attribute_id' => $attributes['package_size'], 'value' => '30g', 'label' => '30 grams', 'color_code' => null, 'sort_order' => 1, 'status' => 1],
            ['attribute_id' => $attributes['package_size'], 'value' => '60g', 'label' => '60 grams', 'color_code' => null, 'sort_order' => 2, 'status' => 1],
            ['attribute_id' => $attributes['package_size'], 'value' => '100g', 'label' => '100 grams', 'color_code' => null, 'sort_order' => 3, 'status' => 1],
            ['attribute_id' => $attributes['package_size'], 'value' => '250g', 'label' => '250 grams', 'color_code' => null, 'sort_order' => 4, 'status' => 1],
            ['attribute_id' => $attributes['package_size'], 'value' => '25ml', 'label' => '25 ml', 'color_code' => null, 'sort_order' => 5, 'status' => 1],
            ['attribute_id' => $attributes['package_size'], 'value' => '50ml', 'label' => '50 ml', 'color_code' => null, 'sort_order' => 6, 'status' => 1],
            ['attribute_id' => $attributes['package_size'], 'value' => '10 Pills', 'label' => '10 Pills', 'color_code' => null, 'sort_order' => 7, 'status' => 1],
            ['attribute_id' => $attributes['package_size'], 'value' => '30 Pills', 'label' => '30 Pills', 'color_code' => null, 'sort_order' => 8, 'status' => 1],
        ];

        // Flavor attribute values
        $flavors = [
            ['attribute_id' => $attributes['flavor'], 'value' => 'Original', 'label' => 'Original Herbal', 'color_code' => null, 'sort_order' => 1, 'status' => 1],
            ['attribute_id' => $attributes['flavor'], 'value' => 'Honey', 'label' => 'Honey', 'color_code' => null, 'sort_order' => 2, 'status' => 1],
            ['attribute_id' => $attributes['flavor'], 'value' => 'Cardamom', 'label' => 'Cardamom', 'color_code' => null, 'sort_order' => 3, 'status' => 1],
            ['attribute_id' => $attributes['flavor'], 'value' => 'Unflavored', 'label' => 'Unflavored', 'color_code' => null, 'sort_order' => 4, 'status' => 1],
        ];

        // Duration attribute values
        $durations = [
            ['attribute_id' => $attributes['duration'], 'value' => '1 Month', 'label' => '1 Month Supply', 'color_code' => null, 'sort_order' => 1, 'status' => 1],
            ['attribute_id' => $attributes['duration'], 'value' => '3 Months', 'label' => '3 Months Supply', 'color_code' => null, 'sort_order' => 2, 'status' => 1],
            ['attribute_id' => $attributes['duration'], 'value' => '6 Months', 'label' => '6 Months Supply', 'color_code' => null, 'sort_order' => 3, 'status' => 1],
            ['attribute_id' => $attributes['duration'], 'value' => 'Occasional Use', 'label' => 'Occasional Use', 'color_code' => null, 'sort_order' => 4, 'status' => 1],
        ];

        $allValues = array_merge($packageSizes, $flavors, $durations);

        foreach ($allValues as $value) {
            $value['created_at'] = now();
            $value['updated_at'] = now();
            DB::table('attribute_values')->insert($value);
        }
    }

    private function seedCategoryAttributes()
    {
        $categories = DB::table('categories')->pluck('id', 'slug');
        $attributes = DB::table('attributes')->pluck('id', 'code');

        $categoryAttributes = [];

        // All categories get Package Size
        foreach ($categories as $slug => $categoryId) {
            $categoryAttributes[] = ['category_id' => $categoryId, 'attribute_id' => $attributes['package_size'], 'is_required' => 1, 'is_filterable' => 1, 'sort_order' => 1];
        }

        // Herbal Pastes get Flavor
        $categoryAttributes[] = ['category_id' => $categories['herbal-pastes'], 'attribute_id' => $attributes['flavor'], 'is_required' => 0, 'is_filterable' => 1, 'sort_order' => 2];

        // Oral Supplements get Duration
        $categoryAttributes[] = ['category_id' => $categories['oral-supplements'], 'attribute_id' => $attributes['duration'], 'is_required' => 1, 'is_filterable' => 1, 'sort_order' => 2];

        foreach ($categoryAttributes as $ca) {
            $ca['created_at'] = now();
            $ca['updated_at'] = now();
            DB::table('category_attributes')->insert($ca);
        }
    }

    private function seedTaxClasses()
    {
        $taxClasses = [
            [
                'name' => 'Ayurvedic Products',
                'code' => 'ayurvedic_products',
                'description' => 'Standard tax rate for Ayurvedic and herbal products',
                'is_default' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tax_classes')->insert($taxClasses);

        // Add tax rates
        $taxClassId = DB::table('tax_classes')->where('code', 'ayurvedic_products')->first()->id;

        $taxRates = [
            [
                'tax_class_id' => $taxClassId,
                'name' => 'India Standard',
                'country_code' => 'IN',
                'state_code' => null,
                'zip_code' => null,
                'rate' => 12.0,
                'is_active' => 1,
                'priority' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tax_rates')->insert($taxRates);
    }

    private function seedProductsAndVariants()
    {
        $categories = DB::table('categories')->pluck('id', 'slug');
        $brands = DB::table('brands')->pluck('id', 'slug');
        $taxClass = DB::table('tax_classes')->where('code', 'ayurvedic_products')->first();
        $attributes = DB::table('attributes')->pluck('id', 'code');
        $attributeValues = DB::table('attribute_values')->get();

        // Get attribute value IDs
        $packageSizeValues = [];
        $flavorValues = [];
        $durationValues = [];

        foreach ($attributeValues as $value) {
            if ($value->attribute_id == $attributes['package_size']) {
                $packageSizeValues[$value->value] = $value->id;
            } elseif ($value->attribute_id == $attributes['flavor']) {
                $flavorValues[$value->value] = $value->id;
            } elseif ($value->attribute_id == $attributes['duration']) {
                $durationValues[$value->value] = $value->id;
            }
        }

        // ==================== PRODUCT DEFINITIONS ====================

        $products = [];

        // ==================== 1. STREE SHAKTI ====================
        $products[] = [
            'name' => 'STREE SHAKTI – Premium Chyawanprash Paste for Women',
            'slug' => 'stree-shakti-premium-chyawanprash-paste',
            'product_type' => 'configurable',
            'brand_id' => $brands['ved-herbs-ayurveda'],
            'main_category_id' => $categories['womens-wellness'],
            'tax_class_id' => $taxClass->id,
            'short_description' => 'Stamina Booster Chyawanprash for Inner Strength, Balance & Confidence',
            'description' => $this->getStreeShaktiDescription(),
            'status' => 'active',
            'is_featured' => 1,
            'is_new' => 1,
            'is_bestseller' => 1,
            'weight' => 60,
            'length' => 8,
            'width' => 8,
            'height' => 6,
            'meta_title' => 'Stree Shakti Chyawanprash - Women\'s Vitality & Hormonal Balance',
            'meta_description' => 'Premium Ayurvedic chyawanprash paste for women\'s stamina, hormonal balance, and overall wellness with Sona Bhasm & Chandi Bhasm.',
            'meta_keywords' => 'stree shakti, womens chyawanprash, hormonal balance, ayurvedic paste, womens vitality',
            'canonical_url' => '/ayurveda/womens-wellness/stree-shakti-chyawanprash-paste',
            'product_code' => 'VED-SS-001',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // ==================== 2. PRIME GOLD POWER ====================
        $products[] = [
            'name' => 'PRIME GOLD POWER – Premium Golden Ball Pills for Men',
            'slug' => 'prime-gold-power-golden-ball-pills',
            'product_type' => 'simple',
            'brand_id' => $brands['ved-herbs-ayurveda'],
            'main_category_id' => $categories['mens-wellness'],
            'tax_class_id' => $taxClass->id,
            'short_description' => 'Unlock Your Prime – Long Lasting Strength, Confidence & Performance',
            'description' => $this->getPrimeGoldDescription(),
            'status' => 'active',
            'is_featured' => 1,
            'is_new' => 1,
            'is_bestseller' => 1,
            'weight' => 50,
            'length' => 6,
            'width' => 6,
            'height' => 6,
            'meta_title' => 'Prime Gold Power Pills - Men\'s Stamina & Performance',
            'meta_description' => 'Premium golden ball pills for men\'s stamina, endurance, and performance. Enriched with Shilajit, Ashwagandha, and Sona Bhasm.',
            'meta_keywords' => 'prime gold power, mens pills, stamina booster, performance enhancer, golden balls',
            'canonical_url' => '/ayurveda/mens-wellness/prime-gold-power-pills',
            'product_code' => 'VED-PGP-002',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // ==================== 3. POWER GEL ====================
        $products[] = [
            'name' => 'POWER GEL – Premium Herbal Performance Gel for Men',
            'slug' => 'power-gel-premium-herbal-performance',
            'product_type' => 'configurable',
            'brand_id' => $brands['ved-herbs-ayurveda'],
            'main_category_id' => $categories['external-applications'],
            'tax_class_id' => $taxClass->id,
            'short_description' => 'For Long Lasting Time, Confidence, and Complete Satisfaction',
            'description' => $this->getPowerGelDescription(),
            'status' => 'active',
            'is_featured' => 1,
            'is_new' => 0,
            'is_bestseller' => 1,
            'weight' => 50,
            'length' => 5,
            'width' => 5,
            'height' => 8,
            'meta_title' => 'Power Gel - Herbal Performance Gel for Men',
            'meta_description' => 'Ayurvedic herbal gel for men\'s performance, stamina, and confidence. Non-sticky, fast-absorbing formula.',
            'meta_keywords' => 'power gel, mens gel, performance gel, herbal gel, stamina gel',
            'canonical_url' => '/ayurveda/external-applications/power-gel',
            'product_code' => 'VED-PG-003',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // ==================== 4. POWERMAX OIL ====================
        $products[] = [
            'name' => 'POWERMAX OIL – Premium Ayurvedic Massage Oil for Men',
            'slug' => 'powermax-oil-ayurvedic-massage-oil',
            'product_type' => 'configurable',
            'brand_id' => $brands['ved-herbs-ayurveda'],
            'main_category_id' => $categories['external-applications'],
            'tax_class_id' => $taxClass->id,
            'short_description' => 'For Long Lasting Time, Strength & Complete Confidence',
            'description' => $this->getPowermaxOilDescription(),
            'status' => 'active',
            'is_featured' => 1,
            'is_new' => 1,
            'is_bestseller' => 1,
            'weight' => 30,
            'length' => 4,
            'width' => 4,
            'height' => 10,
            'meta_title' => 'PowerMax Oil - Ayurvedic Massage Oil for Men',
            'meta_description' => 'Premium Ayurvedic massage oil for men\'s stamina, endurance, and confidence. Enriched with Shilajit and Ashwagandha.',
            'meta_keywords' => 'powermax oil, massage oil, mens oil, stamina oil, ayurvedic oil',
            'canonical_url' => '/ayurveda/external-applications/powermax-oil',
            'product_code' => 'VED-PO-004',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // ==================== 5. PACHAN SHAKTI POWDER ====================
        $products[] = [
            'name' => 'PACHAN SHAKTI POWDER – Ayurvedic Relief from Constipation',
            'slug' => 'pachan-shakti-powder-constipation-relief',
            'product_type' => 'configurable',
            'brand_id' => $brands['ved-herbs-ayurveda'],
            'main_category_id' => $categories['digestive-health'],
            'tax_class_id' => $taxClass->id,
            'short_description' => 'Gentle, Natural, and Effective Relief from Constipation',
            'description' => $this->getPachanShaktiDescription(),
            'status' => 'active',
            'is_featured' => 1,
            'is_new' => 1,
            'is_bestseller' => 0,
            'weight' => 100,
            'length' => 10,
            'width' => 10,
            'height' => 5,
            'meta_title' => 'Pachan Shakti Powder - Ayurvedic Constipation Relief',
            'meta_description' => 'Natural Ayurvedic powder for constipation relief and digestive health. Contains Triphala, Psyllium Husk, and digestive herbs.',
            'meta_keywords' => 'pachan shakti, constipation relief, digestive powder, triphala, gut health',
            'canonical_url' => '/ayurveda/digestive-health/pachan-shakti-powder',
            'product_code' => 'VED-PS-005',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // ==================== 6. AYUSHAKTI PASTE ====================
        $products[] = [
            'name' => 'AYUSHAKTI – Ayurvedic Vitality Paste',
            'slug' => 'ayushakti-ayurvedic-vitality-paste',
            'product_type' => 'configurable',
            'brand_id' => $brands['ved-herbs-ayurveda'],
            'main_category_id' => $categories['herbal-pastes'],
            'tax_class_id' => $taxClass->id,
            'short_description' => 'Enhances strength, stamina, and overall vitality naturally',
            'description' => $this->getAyushaktiDescription(),
            'status' => 'active',
            'is_featured' => 1,
            'is_new' => 0,
            'is_bestseller' => 1,
            'weight' => 60,
            'length' => 8,
            'width' => 8,
            'height' => 6,
            'meta_title' => 'Ayushakti Paste - Ayurvedic Vitality & Stamina Booster',
            'meta_description' => 'Powerful Ayurvedic herbal paste to enhance strength, stamina, and vitality. Contains Ashwagandha, Shilajit, and Safed Musli.',
            'meta_keywords' => 'ayushakti, vitality paste, stamina booster, herbal paste, energy paste',
            'canonical_url' => '/ayurveda/herbal-pastes/ayushakti-paste',
            'product_code' => 'VED-AK-006',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // ==================== 7. PRIME TIME PASTE ====================
        $products[] = [
            'name' => 'PRIME TIME – Herbal Relaxation Paste',
            'slug' => 'prime-time-herbal-relaxation-paste',
            'product_type' => 'configurable',
            'brand_id' => $brands['ved-herbs-ayurveda'],
            'main_category_id' => $categories['herbal-pastes'],
            'tax_class_id' => $taxClass->id,
            'short_description' => 'Promotes relaxation and restful sleep naturally',
            'description' => $this->getPrimeTimeDescription(),
            'status' => 'active',
            'is_featured' => 0,
            'is_new' => 1,
            'is_bestseller' => 1,
            'weight' => 60,
            'length' => 8,
            'width' => 8,
            'height' => 6,
            'meta_title' => 'Prime Time Paste - Herbal Relaxation & Sleep Support',
            'meta_description' => 'Ayurvedic herbal paste for relaxation and restful sleep. Natural formula for stress relief and wellness.',
            'meta_keywords' => 'prime time, relaxation paste, sleep support, herbal paste, stress relief',
            'canonical_url' => '/ayurveda/herbal-pastes/prime-time-paste',
            'product_code' => 'VED-PT-007',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // ==================== INSERT PRODUCTS AND CREATE VARIANTS ====================

        $productIds = [];

        foreach ($products as $index => $productData) {
            // Insert product
            $productId = DB::table('products')->insertGetId($productData);
            $productIds[] = $productId;

            // Create variants based on product type
            $this->createProductVariants(
                $productId,
                $productData,
                $categories,
                $packageSizeValues,
                $flavorValues,
                $durationValues
            );

            // Add product specifications
            $this->addProductSpecifications($productId, $productData);

            // Store product ID in array for relationships
            $products[$index]['id'] = $productId;
        }

        return $productIds;
    }

    private function createProductVariants(
        $productId,
        $productData,
        $categories,
        $packageSizeValues,
        $flavorValues,
        $durationValues
    ) {
        $categorySlug = collect($categories)
            ->flip()
            ->get($productData['main_category_id']);

        if (!$categorySlug) {
            return;
        }

        $variants = [];

        switch ($categorySlug) {
            case 'herbal-pastes':
                $variants = $this->createHerbalPasteVariants($productId, $productData, $packageSizeValues, $flavorValues);
                break;

            case 'external-applications':
                $variants = $this->createExternalApplicationVariants($productId, $productData, $packageSizeValues);
                break;

            case 'digestive-health':
                $variants = $this->createDigestiveProductVariants($productId, $productData, $packageSizeValues);
                break;

            case 'oral-supplements':
                $variants = $this->createOralSupplementVariants($productId, $productData, $packageSizeValues, $durationValues);
                break;

            case 'mens-wellness':
            case 'womens-wellness':
                $variants = $this->createWellnessProductVariants($productId, $productData, $packageSizeValues);
                break;
        }

        foreach ($variants as $variantData) {
            $variantId = DB::table('product_variants')->insertGetId($variantData['variant']);

            foreach ($variantData['attributes'] as $attributeData) {
                DB::table('variant_attributes')->insert([
                    'variant_id' => $variantId,
                    'attribute_id' => $attributeData['attribute_id'],
                    'attribute_value_id' => $attributeData['attribute_value_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->addVariantImages($variantId, $productId);
        }
    }

    private function createHerbalPasteVariants($productId, $productData, $packageSizeValues, $flavorValues)
    {
        $variants = [];
        $packageSizes = ['60g', '100g', '250g'];
        $flavors = ['Original', 'Honey', 'Cardamom'];
        $skuBase = str_replace('VED-', '', $productData['product_code']);
        $variantCount = 1;

        foreach ($packageSizes as $size) {
            foreach ($flavors as $flavor) {
                $sku = $skuBase . '-' . str_pad($variantCount, 3, '0', STR_PAD_LEFT);
                $combinationHash = md5($size . $flavor);

                $variants[] = [
                    'variant' => [
                        'product_id' => $productId,
                        'sku' => $sku,
                        'combination_hash' => $combinationHash,
                        'price' => $this->getPriceForHerbalPaste($size),
                        'compare_price' => $this->getPriceForHerbalPaste($size) * 1.3,
                        'cost_price' => $this->getPriceForHerbalPaste($size) * 0.4,
                        'stock_quantity' => rand(30, 150),
                        'reserved_quantity' => 0,
                        'stock_status' => 'in_stock',
                        'is_default' => ($variantCount === 1) ? 1 : 0,
                        'status' => 1,
                        'weight' => (int) str_replace('g', '', $size),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    'attributes' => [
                        ['attribute_id' => DB::table('attributes')->where('code', 'package_size')->first()->id, 'attribute_value_id' => $packageSizeValues[$size]],
                        ['attribute_id' => DB::table('attributes')->where('code', 'flavor')->first()->id, 'attribute_value_id' => $flavorValues[$flavor]],
                    ]
                ];
                $variantCount++;
            }
        }

        return $variants;
    }

    private function createExternalApplicationVariants($productId, $productData, $packageSizeValues)
    {
        $variants = [];

        // Different sizes for different products
        if (strpos($productData['name'], 'GEL') !== false) {
            $sizes = ['25ml', '50ml'];
            $basePrice = 450;
        } else {
            $sizes = ['25ml', '50ml'];
            $basePrice = 550;
        }

        $skuBase = str_replace('VED-', '', $productData['product_code']);
        $variantCount = 1;

        foreach ($sizes as $size) {
            $sku = $skuBase . '-' . str_pad($variantCount, 3, '0', STR_PAD_LEFT);
            $combinationHash = md5($size);

            $price = $basePrice * ($size === '50ml' ? 1.8 : 1);

            $variants[] = [
                'variant' => [
                    'product_id' => $productId,
                    'sku' => $sku,
                    'combination_hash' => $combinationHash,
                    'price' => $price,
                    'compare_price' => $price * 1.4,
                    'cost_price' => $price * 0.35,
                    'stock_quantity' => rand(20, 100),
                    'reserved_quantity' => 0,
                    'stock_status' => 'in_stock',
                    'is_default' => ($variantCount === 1) ? 1 : 0,
                    'status' => 1,
                    'weight' => (int) str_replace('ml', '', $size),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                'attributes' => [
                    ['attribute_id' => DB::table('attributes')->where('code', 'package_size')->first()->id, 'attribute_value_id' => $packageSizeValues[$size]],
                ]
            ];
            $variantCount++;
        }

        return $variants;
    }

    private function createDigestiveProductVariants($productId, $productData, $packageSizeValues)
    {
        $variants = [];
        $sizes = ['100g', '250g'];
        $skuBase = str_replace('VED-', '', $productData['product_code']);
        $variantCount = 1;

        foreach ($sizes as $size) {
            $sku = $skuBase . '-' . str_pad($variantCount, 3, '0', STR_PAD_LEFT);
            $combinationHash = md5($size);

            $price = $size === '250g' ? 350 : 150;

            $variants[] = [
                'variant' => [
                    'product_id' => $productId,
                    'sku' => $sku,
                    'combination_hash' => $combinationHash,
                    'price' => $price,
                    'compare_price' => $price * 1.35,
                    'cost_price' => $price * 0.45,
                    'stock_quantity' => rand(40, 200),
                    'reserved_quantity' => 0,
                    'stock_status' => 'in_stock',
                    'is_default' => ($variantCount === 1) ? 1 : 0,
                    'status' => 1,
                    'weight' => (int) str_replace('g', '', $size),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                'attributes' => [
                    ['attribute_id' => DB::table('attributes')->where('code', 'package_size')->first()->id, 'attribute_value_id' => $packageSizeValues[$size]],
                ]
            ];
            $variantCount++;
        }

        return $variants;
    }

    private function createOralSupplementVariants($productId, $productData, $packageSizeValues, $durationValues)
    {
        $variants = [];
        $packages = ['10 Pills', '30 Pills'];
        $durations = ['1 Month', '3 Months'];
        $skuBase = str_replace('VED-', '', $productData['product_code']);
        $variantCount = 1;

        foreach ($packages as $package) {
            foreach ($durations as $duration) {
                $sku = $skuBase . '-' . str_pad($variantCount, 3, '0', STR_PAD_LEFT);
                $combinationHash = md5($package . $duration);

                $price = $package === '30 Pills' ? 1200 : 450;

                $variants[] = [
                    'variant' => [
                        'product_id' => $productId,
                        'sku' => $sku,
                        'combination_hash' => $combinationHash,
                        'price' => $price,
                        'compare_price' => $price * 1.5,
                        'cost_price' => $price * 0.3,
                        'stock_quantity' => rand(15, 80),
                        'reserved_quantity' => 0,
                        'stock_status' => 'in_stock',
                        'is_default' => ($variantCount === 1) ? 1 : 0,
                        'status' => 1,
                        'weight' => $package === '30 Pills' ? 30 : 10,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    'attributes' => [
                        ['attribute_id' => DB::table('attributes')->where('code', 'package_size')->first()->id, 'attribute_value_id' => $packageSizeValues[$package]],
                        ['attribute_id' => DB::table('attributes')->where('code', 'duration')->first()->id, 'attribute_value_id' => $durationValues[$duration]],
                    ]
                ];
                $variantCount++;
            }
        }

        return $variants;
    }

    private function createWellnessProductVariants($productId, $productData, $packageSizeValues)
    {
        $variants = [];

        // Different products have different sizes
        if (strpos($productData['name'], 'STREE SHAKTI') !== false) {
            $sizes = ['60g', '100g'];
            $basePrice = 600;
        } else {
            $sizes = ['60g'];
            $basePrice = 800;
        }

        $skuBase = str_replace('VED-', '', $productData['product_code']);
        $variantCount = 1;

        foreach ($sizes as $size) {
            $sku = $skuBase . '-' . str_pad($variantCount, 3, '0', STR_PAD_LEFT);
            $combinationHash = md5($size);

            $price = $basePrice * ($size === '100g' ? 1.6 : 1);

            $variants[] = [
                'variant' => [
                    'product_id' => $productId,
                    'sku' => $sku,
                    'combination_hash' => $combinationHash,
                    'price' => $price,
                    'compare_price' => $price * 1.4,
                    'cost_price' => $price * 0.4,
                    'stock_quantity' => rand(25, 120),
                    'reserved_quantity' => 0,
                    'stock_status' => 'in_stock',
                    'is_default' => ($variantCount === 1) ? 1 : 0,
                    'status' => 1,
                    'weight' => (int) str_replace('g', '', $size),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                'attributes' => [
                    ['attribute_id' => DB::table('attributes')->where('code', 'package_size')->first()->id, 'attribute_value_id' => $packageSizeValues[$size]],
                ]
            ];
            $variantCount++;
        }

        return $variants;
    }

    private function getPriceForHerbalPaste($size)
    {
        $prices = [
            '60g' => 300,
            '100g' => 450,
            '250g' => 900,
        ];

        return $prices[$size] ?? 300;
    }

    private function addVariantImages($variantId, $productId)
    {
        // Use media IDs 10-20 for variant images
        $mediaIds = [10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        // Select 2-3 random media IDs for this variant
        $selectedIndices = array_rand($mediaIds, rand(2, 3));
        if (!is_array($selectedIndices)) {
            $selectedIndices = [$selectedIndices];
        }

        $isPrimary = true;
        foreach ($selectedIndices as $index => $mediaIndex) {
            DB::table('variant_images')->insert([
                'variant_id' => $variantId,
                'media_id' => $mediaIds[$mediaIndex],
                'is_primary' => $isPrimary ? 1 : 0,
                'sort_order' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $isPrimary = false;
        }
    }

    private function addProductSpecifications($productId, $productData)
    {
        $specs = DB::table('specifications')->pluck('id', 'code');
        $specValues = DB::table('specification_values')->get()->groupBy('specification_id');

        // Common specifications for all Ayurvedic products
        $baseSpecs = [
            [
                'specification_id' => $specs['manufacturing_standards'],
                'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['manufacturing_standards']], 'GMP Certified'),
            ],
            [
                'specification_id' => $specs['dietary_compatibility'],
                'specification_value_id' => null,
                'custom_value' => 'Vegetarian',
            ],
            [
                'specification_id' => $specs['storage_instructions'],
                'specification_value_id' => null,
                'custom_value' => 'Store in a cool, dry place away from direct sunlight and moisture. Keep container tightly closed.',
            ],
        ];

        // Product-specific specifications
        if (strpos($productData['name'], 'STREE SHAKTI') !== false) {
            $baseSpecs = array_merge($baseSpecs, [
                [
                    'specification_id' => $specs['product_form'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['product_form']], 'Chyawanprash'),
                ],
                [
                    'specification_id' => $specs['net_weight'],
                    'specification_value_id' => null,
                    'custom_value' => '60g',
                ],
                [
                    'specification_id' => $specs['shelf_life'],
                    'specification_value_id' => null,
                    'custom_value' => '36 months',
                ],
                [
                    'specification_id' => $specs['main_ingredients'],
                    'specification_value_id' => null,
                    'custom_value' => 'Sona Bhasm (Gold Ash), Chandi Bhasm (Silver Ash), Shatavari, Ashwagandha, Amla, Gokhru, Lodhra, Shilajit, Safed Musli, Honey, Ghee',
                ],
                [
                    'specification_id' => $specs['key_benefits'],
                    'specification_value_id' => null,
                    'custom_value' => 'Promotes female reproductive health, increases energy and stamina, supports hormonal balance, nourishes skin and hair, strengthens immunity',
                ],
                [
                    'specification_id' => $specs['usage_type'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['usage_type']], 'Oral'),
                ],
                [
                    'specification_id' => $specs['dosage'],
                    'specification_value_id' => null,
                    'custom_value' => '1 spoon (5g) daily with warm milk',
                ],
                [
                    'specification_id' => $specs['recommended_duration'],
                    'specification_value_id' => null,
                    'custom_value' => '3-6 months for best results',
                ],
                [
                    'specification_id' => $specs['age_restriction'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['age_restriction']], '18+ Years'),
                ],
                [
                    'specification_id' => $specs['safety_warnings'],
                    'specification_value_id' => null,
                    'custom_value' => 'For adult women only. Consult doctor if pregnant, nursing, or under medical supervision.',
                ],
                [
                    'specification_id' => $specs['time_of_use'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['time_of_use']], 'Morning'),
                ],
            ]);
        } elseif (strpos($productData['name'], 'PRIME GOLD') !== false) {
            $baseSpecs = array_merge($baseSpecs, [
                [
                    'specification_id' => $specs['product_form'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['product_form']], 'Pills/Capsules'),
                ],
                [
                    'specification_id' => $specs['net_weight'],
                    'specification_value_id' => null,
                    'custom_value' => '10 Pills',
                ],
                [
                    'specification_id' => $specs['shelf_life'],
                    'specification_value_id' => null,
                    'custom_value' => '36 months',
                ],
                [
                    'specification_id' => $specs['main_ingredients'],
                    'specification_value_id' => null,
                    'custom_value' => 'Shilajit, Ashwagandha, Safed Musli, Kaunch Beej, Amla, Gokhru, Sona Bhasm, Jaiphal, Shatavari',
                ],
                [
                    'specification_id' => $specs['key_benefits'],
                    'specification_value_id' => null,
                    'custom_value' => 'Provides long-lasting stamina and endurance, boosts strength and performance confidence, enhances energy and masculine power',
                ],
                [
                    'specification_id' => $specs['usage_type'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['usage_type']], 'Oral'),
                ],
                [
                    'specification_id' => $specs['dosage'],
                    'specification_value_id' => null,
                    'custom_value' => '1 pill with warm milk 1 hour before bedtime',
                ],
                [
                    'specification_id' => $specs['recommended_duration'],
                    'specification_value_id' => null,
                    'custom_value' => 'Occasional use only, not for daily consumption',
                ],
                [
                    'specification_id' => $specs['age_restriction'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['age_restriction']], '18+ Years'),
                ],
                [
                    'specification_id' => $specs['safety_warnings'],
                    'specification_value_id' => null,
                    'custom_value' => 'For adult men only. Not for daily use. Avoid alcohol before use. Consult doctor if having heart or kidney issues.',
                ],
                [
                    'specification_id' => $specs['time_of_use'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['time_of_use']], 'Bedtime'),
                ],
            ]);
        } elseif (strpos($productData['name'], 'POWER GEL') !== false) {
            $baseSpecs = array_merge($baseSpecs, [
                [
                    'specification_id' => $specs['product_form'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['product_form']], 'Gel'),
                ],
                [
                    'specification_id' => $specs['net_weight'],
                    'specification_value_id' => null,
                    'custom_value' => '4ml',
                ],
                [
                    'specification_id' => $specs['shelf_life'],
                    'specification_value_id' => null,
                    'custom_value' => '36 months',
                ],
                [
                    'specification_id' => $specs['main_ingredients'],
                    'specification_value_id' => null,
                    'custom_value' => 'Shilajit, Ashwagandha, Jaiphal, Kapoor, Lavang Oil, Til Oil, Javitri, Dalchini',
                ],
                [
                    'specification_id' => $specs['key_benefits'],
                    'specification_value_id' => null,
                    'custom_value' => 'Controls early ejaculation naturally, enhances stamina and endurance, increases blood flow, boosts confidence',
                ],
                [
                    'specification_id' => $specs['usage_type'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['usage_type']], 'External'),
                ],
                [
                    'specification_id' => $specs['dosage'],
                    'specification_value_id' => null,
                    'custom_value' => 'Apply pea-sized amount externally 1 hour before bedtime or intimacy',
                ],
                [
                    'specification_id' => $specs['age_restriction'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['age_restriction']], '18+ Years'),
                ],
                [
                    'specification_id' => $specs['safety_warnings'],
                    'specification_value_id' => null,
                    'custom_value' => 'For external use only. Do not use on broken or irritated skin. Avoid contact with eyes or mouth.',
                ],
            ]);
        } elseif (strpos($productData['name'], 'POWERMAX OIL') !== false) {
            $baseSpecs = array_merge($baseSpecs, [
                [
                    'specification_id' => $specs['product_form'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['product_form']], 'Oil'),
                ],
                [
                    'specification_id' => $specs['net_weight'],
                    'specification_value_id' => null,
                    'custom_value' => '25ml',
                ],
                [
                    'specification_id' => $specs['shelf_life'],
                    'specification_value_id' => null,
                    'custom_value' => '36 months',
                ],
                [
                    'specification_id' => $specs['main_ingredients'],
                    'specification_value_id' => null,
                    'custom_value' => 'Shilajit, Ashwagandha, Jaiphal, Akarkara, Til Oil, Kapoor, Lavang Oil',
                ],
                [
                    'specification_id' => $specs['key_benefits'],
                    'specification_value_id' => null,
                    'custom_value' => 'Improves stamina and endurance, delays early ejaculation naturally, increases blood circulation, strengthens tissues',
                ],
                [
                    'specification_id' => $specs['usage_type'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['usage_type']], 'External'),
                ],
                [
                    'specification_id' => $specs['dosage'],
                    'specification_value_id' => null,
                    'custom_value' => 'Apply 4-5 drops and massage for 2-5 minutes daily or before bedtime',
                ],
                [
                    'specification_id' => $specs['age_restriction'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['age_restriction']], '18+ Years'),
                ],
                [
                    'specification_id' => $specs['safety_warnings'],
                    'specification_value_id' => null,
                    'custom_value' => 'For external use only. Do not apply on cuts or wounds. Avoid use immediately after alcohol.',
                ],
            ]);
        } elseif (strpos($productData['name'], 'PACHAN SHAKTI') !== false) {
            $baseSpecs = array_merge($baseSpecs, [
                [
                    'specification_id' => $specs['product_form'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['product_form']], 'Powder'),
                ],
                [
                    'specification_id' => $specs['net_weight'],
                    'specification_value_id' => null,
                    'custom_value' => '100g',
                ],
                [
                    'specification_id' => $specs['shelf_life'],
                    'specification_value_id' => null,
                    'custom_value' => '12 months',
                ],
                [
                    'specification_id' => $specs['main_ingredients'],
                    'specification_value_id' => null,
                    'custom_value' => 'Triphala, Psyllium Husk, Himalayan Black Salt, Saunf, Ajwain, Trikatu, Saindhav Salt',
                ],
                [
                    'specification_id' => $specs['key_benefits'],
                    'specification_value_id' => null,
                    'custom_value' => 'Provides effective relief from constipation, improves bowel regularity, reduces bloating, supports gut health and detoxification',
                ],
                [
                    'specification_id' => $specs['usage_type'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['usage_type']], 'Oral'),
                ],
                [
                    'specification_id' => $specs['dosage'],
                    'specification_value_id' => null,
                    'custom_value' => '1 teaspoon (5g) with warm water before bedtime',
                ],
                [
                    'specification_id' => $specs['recommended_duration'],
                    'specification_value_id' => null,
                    'custom_value' => '1-2 weeks or as directed',
                ],
                [
                    'specification_id' => $specs['age_restriction'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['age_restriction']], '18+ Years'),
                ],
                [
                    'specification_id' => $specs['safety_warnings'],
                    'specification_value_id' => null,
                    'custom_value' => 'For adults only. Not recommended for pregnant or lactating women without consultation.',
                ],
                [
                    'specification_id' => $specs['time_of_use'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['time_of_use']], 'Bedtime'),
                ],
            ]);
        } elseif (strpos($productData['name'], 'AYUSHAKTI') !== false) {
            $baseSpecs = array_merge($baseSpecs, [
                [
                    'specification_id' => $specs['product_form'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['product_form']], 'Herbal Paste'),
                ],
                [
                    'specification_id' => $specs['net_weight'],
                    'specification_value_id' => null,
                    'custom_value' => '60g',
                ],
                [
                    'specification_id' => $specs['shelf_life'],
                    'specification_value_id' => null,
                    'custom_value' => '12 months',
                ],
                [
                    'specification_id' => $specs['main_ingredients'],
                    'specification_value_id' => null,
                    'custom_value' => 'Ashwagandha, Shilajit, Safed Musli, Kaunch Beej, Gokshura, Amla',
                ],
                [
                    'specification_id' => $specs['key_benefits'],
                    'specification_value_id' => null,
                    'custom_value' => 'Increases physical strength and stamina, enhances vitality and performance, reduces fatigue and stress, supports hormonal balance',
                ],
                [
                    'specification_id' => $specs['usage_type'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['usage_type']], 'Oral'),
                ],
                [
                    'specification_id' => $specs['dosage'],
                    'specification_value_id' => null,
                    'custom_value' => '1 teaspoon (5g) with warm milk once daily at night after meals',
                ],
                [
                    'specification_id' => $specs['recommended_duration'],
                    'specification_value_id' => null,
                    'custom_value' => 'Minimum 3 months for best results',
                ],
                [
                    'specification_id' => $specs['age_restriction'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['age_restriction']], '18+ Years'),
                ],
                [
                    'specification_id' => $specs['safety_warnings'],
                    'specification_value_id' => null,
                    'custom_value' => 'Not recommended for children below 18 years. Consult physician if having medical conditions.',
                ],
                [
                    'specification_id' => $specs['time_of_use'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['time_of_use']], 'Bedtime'),
                ],
            ]);
        } elseif (strpos($productData['name'], 'PRIME TIME') !== false) {
            $baseSpecs = array_merge($baseSpecs, [
                [
                    'specification_id' => $specs['product_form'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['product_form']], 'Herbal Paste'),
                ],
                [
                    'specification_id' => $specs['net_weight'],
                    'specification_value_id' => null,
                    'custom_value' => '60g',
                ],
                [
                    'specification_id' => $specs['shelf_life'],
                    'specification_value_id' => null,
                    'custom_value' => '12 months',
                ],
                [
                    'specification_id' => $specs['main_ingredients'],
                    'specification_value_id' => null,
                    'custom_value' => '100% natural Ayurvedic herbs (classical formulation)',
                ],
                [
                    'specification_id' => $specs['key_benefits'],
                    'specification_value_id' => null,
                    'custom_value' => 'Supports overall wellness and vitality, promotes relaxation and restful sleep, 100% natural Ayurvedic ingredients',
                ],
                [
                    'specification_id' => $specs['usage_type'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['usage_type']], 'Oral'),
                ],
                [
                    'specification_id' => $specs['dosage'],
                    'specification_value_id' => null,
                    'custom_value' => '1 teaspoon daily before bedtime, can be taken directly or mixed with warm water/milk',
                ],
                [
                    'specification_id' => $specs['age_restriction'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['age_restriction']], 'Adults Only'),
                ],
                [
                    'specification_id' => $specs['safety_warnings'],
                    'specification_value_id' => null,
                    'custom_value' => 'Keep out of reach of children. If pregnant, nursing, or under medical supervision, consult healthcare professional.',
                ],
                [
                    'specification_id' => $specs['time_of_use'],
                    'specification_value_id' => $this->getRandomSpecValueId($specValues[$specs['time_of_use']], 'Bedtime'),
                ],
            ]);
        }

        // Insert specifications
        foreach ($baseSpecs as $spec) {
            DB::table('product_specifications')->insert([
                'product_id' => $productId,
                'specification_id' => $spec['specification_id'],
                'specification_value_id' => $spec['specification_value_id'],
                'custom_value' => $spec['custom_value'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function getRandomSpecValueId($values, $preferredValue = null)
    {
        if ($preferredValue && $values) {
            foreach ($values as $value) {
                if ($value->value === $preferredValue) {
                    return $value->id;
                }
            }
        }

        if ($values && count($values) > 0) {
            return $values[array_rand($values->toArray())]->id;
        }

        return null;
    }

    private function seedProductRelationships()
    {
        $products = DB::table('products')->get();
        $categories = DB::table('categories')->pluck('id', 'slug');
        $tags = DB::table('tags')->pluck('id', 'name');

        foreach ($products as $product) {
            // Add to main category (primary)
            DB::table('category_product')->insert([
                'product_id' => $product->id,
                'category_id' => $product->main_category_id,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add to 1-2 additional related categories
            $allCategoryIds = array_values($categories->toArray());
            $additionalCount = rand(1, 2);
            $additionalCategories = array_rand($allCategoryIds, $additionalCount);

            if (!is_array($additionalCategories)) {
                $additionalCategories = [$additionalCategories];
            }

            foreach ($additionalCategories as $catIndex) {
                $categoryId = $allCategoryIds[$catIndex];
                if ($categoryId != $product->main_category_id) {
                    DB::table('category_product')->insert([
                        'product_id' => $product->id,
                        'category_id' => $categoryId,
                        'is_primary' => 0,
                        'sort_order' => rand(1, 10),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Add tags based on product characteristics
            $productTags = ['Ayurvedic', '100% Natural', 'Herbal', 'No Side Effects'];

            // Category-specific tags
            if (strpos($product->name, 'STREE') !== false || strpos($product->name, 'Women') !== false) {
                $productTags[] = 'Women\'s Health';
                $productTags[] = 'Hormonal Balance';
            }
            if (strpos($product->name, 'MEN') !== false || strpos($product->name, 'POWER') !== false) {
                $productTags[] = 'Men\'s Health';
                $productTags[] = 'Stamina';
                $productTags[] = 'Performance';
            }
            if (strpos($product->name, 'DIGESTIVE') !== false || strpos($product->name, 'PACHAN') !== false) {
                $productTags[] = 'Digestive Health';
                $productTags[] = 'Detox';
            }
            if (strpos($product->name, 'VITALITY') !== false || strpos($product->name, 'ENERGY') !== false) {
                $productTags[] = 'Energy Booster';
                $productTags[] = 'Vitality';
            }
            if (strpos($product->name, 'RELAXATION') !== false || strpos($product->name, 'SLEEP') !== false) {
                $productTags[] = 'Stress Relief';
                $productTags[] = 'Rejuvenating';
            }

            // Insert unique tags
            $uniqueTags = array_unique($productTags);
            foreach ($uniqueTags as $tagName) {
                if (isset($tags[$tagName])) {
                    DB::table('product_tags')->insert([
                        'product_id' => $product->id,
                        'tag_id' => $tags[$tagName],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Add 3-4 related products (random, but not itself)
            $allProductIds = $products->pluck('id')->toArray();
            $relatedCount = min(4, count($allProductIds) - 1);
            $possibleRelatedIds = array_diff($allProductIds, [$product->id]);
            $relatedIds = array_rand(array_flip($possibleRelatedIds), $relatedCount);

            if (!is_array($relatedIds)) {
                $relatedIds = [$relatedIds];
            }

            foreach ($relatedIds as $relatedId) {
                DB::table('related_products')->insert([
                    'product_id' => $product->id,
                    'related_product_id' => $relatedId,
                    'sort_order' => rand(1, 10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    // Product Description Methods
    private function getStreeShaktiDescription()
    {
        return "<h2>STREE SHAKTI – Premium Chyawanprash Paste for Women</h2>
        <p><strong>\"Stamina Booster Chyawanprash for Inner Strength, Balance & Confidence\"</strong></p>
        
        <h3>🔰 Product Overview</h3>
        <p>Ved Herbs & Ayurveda Stree Shakti Chyawanprash Paste is a special Ayurvedic formulation designed exclusively for women's holistic vitality, stamina, and hormonal balance.
        Crafted with Sona Bhasm (Gold Ash) and Chandi Bhasm (Silver Ash) — two ancient Rasayanas known for rejuvenation — this chyawanprash nourishes women's health from within, improving energy, endurance, and emotional balance naturally.</p>
        
        <h3>🌸 Key Ayurvedic Benefits</h3>
        <ul>
            <li>✅ Promotes female reproductive and hormonal balance</li>
            <li>✅ Increases energy, stamina, and endurance</li>
            <li>✅ Supports healthy menstrual cycles and emotional stability</li>
            <li>✅ Improves sexual health, desire, and satisfaction naturally</li>
            <li>✅ Nourishes skin, hair, and overall complexion</li>
            <li>✅ Strengthens immunity, bone health, and muscle tone</li>
            <li>✅ Reduces fatigue, weakness, and stress-related symptoms</li>
            <li>✅ Acts as a natural rejuvenator for women of all ages</li>
            <li>✅ Enriched with Sona Bhasm & Chandi Bhasm for long-term feminine vitality</li>
        </ul>
        
        <h3>🕒 How to Use for Best Results</h3>
        <ol>
            <li>Take 1 spoon (approx. 5g) of Stree Shakti Chyawanprash Paste.</li>
            <li>Consume once daily with a glass of warm milk.</li>
            <li>It can be taken in the morning or before bedtime.</li>
            <li>Continue use regularly for 3 to 6 months for visible and lasting benefits.</li>
            <li>Always use a clean and dry spoon for every dose to maintain product purity.</li>
        </ol>
        
        <h3>⚗️ Key Ayurvedic Ingredients</h3>
        <ul>
            <li><strong>Sona Bhasm (Gold Ash):</strong> Enhances strength, glow, and reproductive rejuvenation.</li>
            <li><strong>Chandi Bhasm (Silver Ash):</strong> Calms the mind, improves focus, and regulates mood.</li>
            <li><strong>Shatavari:</strong> The ultimate female tonic — balances hormones and supports fertility.</li>
            <li><strong>Ashwagandha:</strong> Relieves stress and supports stamina.</li>
            <li><strong>Amla:</strong> Rich in Vitamin C, supports immunity and skin health.</li>
        </ul>
        
        <h3>⚠️ Precautions</h3>
        <ul>
            <li>For adult women only (18+ years).</li>
            <li>Store in a cool, dry place away from sunlight.</li>
            <li>Keep container tightly closed after each use.</li>
            <li>Do not exceed the recommended dose.</li>
            <li>Consult your doctor if you are pregnant, nursing, or under medical supervision.</li>
            <li>Keep out of reach of children.</li>
        </ul>";
    }

    private function getPrimeGoldDescription()
    {
        return "<h2>PRIME GOLD POWER – Premium Golden Ball Pills for Men</h2>
        <p><strong>\"Unlock Your Prime – Long Lasting Strength, Confidence & Performance\"</strong></p>
        
        <h3>🔰 Product Overview</h3>
        <p>Ved Herbs and Ayurveda – Prime Gold Power is a premium Ayurvedic formulation created for men who desire exceptional stamina, endurance, and long-lasting power.
        Each Golden Ball pill is enriched with ancient Ayurvedic herbs such as Shilajit, Safed Musli, Ashwagandha, Kaunch Beej, and Sona Bhasm, blended using traditional Rasayana principles to enhance performance and vitality.</p>
        
        <h3>💪 Key Ayurvedic Benefits</h3>
        <ul>
            <li>✅ Provides long-lasting stamina and endurance when needed</li>
            <li>✅ Boosts strength, timing, and performance confidence</li>
            <li>✅ Enhances energy and masculine power</li>
            <li>✅ Supports reproductive health and hormone balance</li>
            <li>✅ Reduces fatigue and stress-related weakness</li>
            <li>✅ Improves semen quality and vitality naturally</li>
            <li>✅ Made with Shilajit and other classical rejuvenating herbs</li>
        </ul>
        
        <h3>🕒 How to Use for Best Results</h3>
        <ol>
            <li>Take 1 Golden Ball pill with a glass of warm milk.</li>
            <li>Consume 1 hour before bedtime, after 2–3 hours of your meal.</li>
            <li>Use only occasionally, not daily — as and when desired.</li>
            <li>Always ensure your body is well-rested and hydrated before use.</li>
            <li>Use clean, dry hands or spoon to remove the pill from the jar.</li>
        </ol>
        
        <h3>⚗️ Key Ingredients & Their Benefits</h3>
        <ul>
            <li><strong>Shilajit:</strong> Natural rejuvenator that restores stamina, vigor, and energy.</li>
            <li><strong>Ashwagandha:</strong> Reduces stress and enhances strength and endurance.</li>
            <li><strong>Safed Musli:</strong> Improves sexual vitality and semen quality.</li>
            <li><strong>Kaunch Beej:</strong> Supports fertility and testosterone balance.</li>
            <li><strong>Sona Bhasm:</strong> Acts as a rejuvenator for longevity and stamina.</li>
        </ul>
        
        <h3>⚠️ Precautions</h3>
        <ul>
            <li>For adult men (18+ years) only</li>
            <li>Not for daily consumption</li>
            <li>Store in a cool, dry place away from sunlight</li>
            <li>Do not exceed the recommended dose (1 pill at a time)</li>
            <li>Avoid alcohol or heavy food before use</li>
            <li>Not advised for individuals with heart or kidney issues without doctor's advice</li>
            <li>Keep out of reach of children</li>
        </ul>";
    }

    private function getPowerGelDescription()
    {
        return "<h2>POWER GEL – Premium Herbal Performance Gel for Men</h2>
        <p><strong>\"For Long Lasting Time, Confidence, and Complete Satisfaction\"</strong></p>
        
        <h3>🔰 Product Overview</h3>
        <p>Ved Herbs and Ayurveda Power Gel is a uniquely formulated herbal performance enhancer designed for men to improve stamina, strength, and timing during intimacy.
        It is a non-sticky, fast-absorbing gel that helps promote blood circulation, enhances performance duration, and provides natural control over early ejaculation.</p>
        
        <h3>💪 Key Ayurvedic Benefits</h3>
        <ul>
            <li>✅ Helps in controlling early ejaculation naturally</li>
            <li>✅ Enhances stamina, endurance, and timing</li>
            <li>✅ Increases blood flow to the penile region for stronger performance</li>
            <li>✅ Boosts confidence and pleasure satisfaction</li>
            <li>✅ Provides natural cooling and warming sensations</li>
            <li>✅ Improves long-term sexual health and performance balance</li>
            <li>✅ Made with 100% Ayurvedic herbs — safe and non-irritating formula</li>
        </ul>
        
        <h3>🕒 How to Use for Best Results</h3>
        <ol>
            <li>Take a small amount (pea-sized) of Power Gel on your fingertip.</li>
            <li>Apply gently on the penis head (cap) and upper shaft.</li>
            <li>Massage slowly in circular motion for 2–3 minutes until absorbed.</li>
            <li>Use 1 hour before bedtime or before intimacy.</li>
            <li>For best results, take light meals before use.</li>
            <li>Wash hands before and after application.</li>
        </ol>
        
        <h3>⚗️ Key Ingredients</h3>
        <ul>
            <li><strong>Shilajit:</strong> Strengthens stamina and supports reproductive health.</li>
            <li><strong>Ashwagandha:</strong> Reduces stress and improves energy and endurance.</li>
            <li><strong>Jaiphal (Nutmeg):</strong> Acts as a natural aphrodisiac and energizer.</li>
            <li><strong>Kapoor (Camphor):</strong> Stimulates blood flow and helps maintain erection firmness.</li>
            <li><strong>Lavang Oil:</strong> Increases sensitivity control and enhances timing.</li>
        </ul>
        
        <h3>⚠️ Precautions</h3>
        <ul>
            <li>For external use only</li>
            <li>For adult men (18+) only</li>
            <li>Do not use on broken, irritated, or infected skin</li>
            <li>Store in a cool, dry place away from direct sunlight</li>
            <li>Keep away from children</li>
            <li>Avoid contact with eyes or mouth</li>
            <li>Wash hands after every use</li>
            <li>Do not use immediately before or after alcohol consumption</li>
        </ul>";
    }

    private function getPowermaxOilDescription()
    {
        return "<h2>POWERMAX OIL – Premium Ayurvedic Massage Oil for Men</h2>
        <p><strong>\"For Long Lasting Time, Strength & Complete Confidence\"</strong></p>
        
        <h3>🔰 Product Overview</h3>
        <p>Ved Herbs and Ayurveda PowerMax Oil is a premium Ayurvedic herbal oil specially formulated for men seeking enhanced stamina, endurance, and sexual confidence.
        This advanced formulation is designed to improve blood flow, strengthen penile tissues, and promote natural long-lasting performance.</p>
        
        <h3>💪 Key Ayurvedic Benefits</h3>
        <ul>
            <li>✅ Improves stamina and sexual endurance</li>
            <li>✅ Helps delay early ejaculation naturally</li>
            <li>✅ Increases blood circulation to the penile area</li>
            <li>✅ Strengthens and tones penile tissues</li>
            <li>✅ Enhances timing and performance control</li>
            <li>✅ Improves confidence and satisfaction</li>
            <li>✅ Supports long-term male sexual health</li>
            <li>✅ Made from 100% Ayurvedic and natural ingredients</li>
        </ul>
        
        <h3>🕒 How to Use for Best Results</h3>
        <ol>
            <li>Take 4–5 drops of PowerMax Oil on your palm.</li>
            <li>Gently apply on the penis and massage slowly from root to tip for 2–5 minutes.</li>
            <li>Use circular and upward strokes until the oil is absorbed completely.</li>
            <li>Apply daily or 1 hour before bedtime.</li>
            <li>For best results, use regularly for 2–3 months.</li>
        </ol>
        
        <h3>⚗️ Key Ingredients</h3>
        <ul>
            <li><strong>Shilajit:</strong> Enhances strength, power, and sexual vitality.</li>
            <li><strong>Ashwagandha:</strong> Reduces stress and promotes endurance.</li>
            <li><strong>Jaiphal (Nutmeg):</strong> Acts as a natural aphrodisiac for energy and stamina.</li>
            <li><strong>Akarkara:</strong> Improves blood flow and strengthens nerves.</li>
            <li><strong>Til (Sesame) Oil:</strong> Nourishes and softens skin for smooth massage absorption.</li>
        </ul>
        
        <h3>⚠️ Precautions</h3>
        <ul>
            <li>For external use only</li>
            <li>For adult men (18+) only</li>
            <li>Do not use on cuts, wounds, or infected skin</li>
            <li>Store in a cool, dry place away from sunlight</li>
            <li>Avoid use immediately after alcohol or heavy meals</li>
            <li>Wash hands before and after use</li>
            <li>Keep away from children</li>
            <li>Discontinue use if irritation occurs</li>
        </ul>";
    }

    private function getPachanShaktiDescription()
    {
        return "<h2>PACHAN SHAKTI POWDER – Ayurvedic Relief from Constipation</h2>
        <p><strong>\"Gentle, Natural, and Effective Relief from Constipation\"</strong></p>
        
        <h3>🔰 Product Overview</h3>
        <p>Pachan Shakti Powder is a premium Ayurvedic formulation designed to support healthy digestion and relieve constipation naturally.
        It is a gentle yet effective blend of time-tested herbs that work to stimulate bowel movements, improve digestion, and detoxify the digestive system.</p>
        
        <h3>💪 Key Benefits</h3>
        <ul>
            <li>✅ Provides effective relief from constipation</li>
            <li>✅ Improves bowel regularity and digestive function</li>
            <li>✅ Reduces bloating and abdominal discomfort</li>
            <li>✅ Supports gut health and natural detoxification</li>
            <li>✅ Enhances appetite and nutrient absorption</li>
            <li>✅ Promotes overall digestive wellness</li>
            <li>✅ Gentle and safe for daily use</li>
        </ul>
        
        <h3>🕒 How to Use for Best Results</h3>
        <ol>
            <li>Take 1 teaspoon of Pachan Shakti Powder (approx. 5 grams).</li>
            <li>Mix with a glass of warm water.</li>
            <li>Consume preferably before bedtime or as recommended by an Ayurvedic practitioner.</li>
            <li>Drink plenty of water throughout the day to aid digestion.</li>
            <li>For best results, use regularly for 1–2 weeks or as directed.</li>
        </ol>
        
        <h3>⚗️ Key Ingredients & Their Benefits</h3>
        <ul>
            <li><strong>Triphala:</strong> Helps detoxify the digestive system, regulate bowel movements, and maintain gut health.</li>
            <li><strong>Psyllium Husk (Isabgol):</strong> Natural fiber that softens stools and relieves constipation.</li>
            <li><strong>Himalayan Black Salt:</strong> Aids digestion, stimulates gastric juices, and balances pH in the stomach.</li>
            <li><strong>Saunf (Fennel Seeds):</strong> Reduces bloating, gas, and discomfort.</li>
            <li><strong>Ajwain (Carom Seeds):</strong> Supports digestion, relieves indigestion, and improves appetite.</li>
        </ul>
        
        <h3>⚠️ Precautions</h3>
        <ul>
            <li>For adults only (18+ years)</li>
            <li>Not recommended for pregnant or lactating women without consultation</li>
            <li>Store in a cool, dry place away from direct sunlight</li>
            <li>Keep out of reach of children</li>
            <li>Avoid overdose; adhere to recommended dosage</li>
            <li>If symptoms persist, consult an Ayurvedic doctor</li>
        </ul>";
    }

    private function getAyushaktiDescription()
    {
        return "<h2>AYUSHAKTI – Ayurvedic Vitality Paste</h2>
        <p><strong>Enhances strength, stamina, and overall vitality naturally</strong></p>
        
        <h3>🕉️ Product Overview</h3>
        <p>AYUSHAKTI is a powerful Ayurvedic herbal paste formulated to enhance strength, stamina, and overall vitality.
        Prepared with ancient Ayurvedic herbs, it nourishes the body, supports hormonal balance, and promotes energy and confidence naturally.</p>
        
        <h3>💪 Key Benefits</h3>
        <ul>
            <li>✅ Increases physical strength and stamina</li>
            <li>✅ Enhances male vitality and performance</li>
            <li>✅ Reduces fatigue and stress</li>
            <li>✅ Boosts energy and confidence</li>
            <li>✅ Supports hormonal balance</li>
            <li>✅ Promotes overall wellness and rejuvenation</li>
        </ul>
        
        <h3>🌿 Key Ingredients</h3>
        <ul>
            <li><strong>Ashwagandha:</strong> Strength & vitality</li>
            <li><strong>Shilajit:</strong> Energy and endurance booster</li>
            <li><strong>Safed Musli:</strong> Improves performance and stamina</li>
            <li><strong>Kaunch Beej:</strong> Supports hormonal health</li>
            <li><strong>Gokshura:</strong> Natural tonic for vitality</li>
            <li><strong>Amla:</strong> Rejuvenates body tissues and boosts immunity</li>
        </ul>
        
        <h3>🧴 How to Use</h3>
        <p>Take 1 teaspoon (approx. 5g) of AYUSHAKTI paste with warm milk, once a day — At night after meals.</p>
        
        <h3>⚖️ Dosage</h3>
        <ul>
            <li><strong>Adults:</strong> 1 teaspoon twice daily</li>
            <li><strong>Course Duration:</strong> Minimum 3 months for best results</li>
        </ul>
        
        <h3>⚠️ Safety & Precautions</h3>
        <ul>
            <li>Not recommended for children below 18 years</li>
            <li>Store in a cool, dry place away from sunlight</li>
            <li>Keep out of reach of children</li>
            <li>This is a natural product — results may vary person to person</li>
            <li>Consult your physician if you have any medical condition</li>
        </ul>
        
        <h3>📦 Storage</h3>
        <p>Keep the jar tightly closed. Avoid exposure to moisture or direct heat.</p>";
    }

    private function getPrimeTimeDescription()
    {
        return "<h2>PRIME TIME – Herbal Relaxation Paste</h2>
        <p><strong>Promotes relaxation and restful sleep naturally</strong></p>
        
        <h3>Product Type: Herbal Paste</h3>
        <h3>Recommended Use: Bedtime</h3>
        
        <h3>Dosage Instructions</h3>
        <ul>
            <li>Take 1 teaspoon of Prime Time paste.</li>
            <li>Consume once daily, preferably before bedtime.</li>
            <li>Can be taken directly or mixed with warm water/milk.</li>
        </ul>
        
        <h3>How to Use</h3>
        <ol>
            <li>Take a clean spoon and scoop ½ teaspoon of Prime Time paste.</li>
            <li>Consume it directly or mix with a small amount of warm milk.</li>
            <li>Use consistently for best results.</li>
        </ol>
        
        <h3>Benefits</h3>
        <ul>
            <li>Supports overall wellness and vitality</li>
            <li>Promotes relaxation and restful sleep</li>
            <li>Prepared with 100% natural Ayurvedic ingredients</li>
        </ul>
        
        <h3>Precautions</h3>
        <ul>
            <li>Keep out of reach of children</li>
            <li>Store in a cool, dry place away from direct sunlight</li>
            <li>If pregnant, nursing, or under medical supervision, consult a healthcare professional</li>
        </ul>
        
        <h3>Storage</h3>
        <ul>
            <li>Close the lid tightly after each use</li>
            <li>Refrigeration is not required but recommended in hot climates</li>
        </ul>
        
        <p><em>All ingredients are 100% natural and used as per classical Ayurvedic formulations.</em></p>";
    }
}