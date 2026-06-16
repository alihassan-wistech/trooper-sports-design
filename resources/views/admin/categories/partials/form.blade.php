@php
    $inputClass = 'w-full rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm text-neutral-950 focus:border-black focus:ring-black';
    $labelClass = 'mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-neutral-600';
    $sectionClass = 'space-y-6';
    $repeaterPanelClass = 'rounded-lg border border-neutral-200 bg-neutral-50 p-4';
    $smallButtonClass = 'rounded-md border border-neutral-300 px-3 py-2 text-xs font-semibold uppercase tracking-[0.08em] text-neutral-600 transition hover:border-black hover:text-neutral-950';
    $tabButtonClass = 'whitespace-nowrap rounded-md px-3 py-2 text-sm font-semibold transition';
    $fileInputClass = 'block w-full cursor-pointer rounded-md border border-neutral-300 bg-white text-sm text-neutral-700 file:mr-4 file:border-0 file:bg-neutral-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-neutral-700 focus:border-black focus:ring-black';

    $listValue = function (string $field) use ($category): array {
        $value = old($field);

        if ($value === null) {
            $value = $category->{$field} ?? [];
        }

        $value = is_array($value) ? array_values($value) : [];

        return $value === [] ? [''] : $value;
    };

    $rowValue = function (string $field, array $emptyRow) use ($category): array {
        $value = old($field);

        if ($value === null) {
            $value = $category->{$field} ?? [];
        }

        if (! is_array($value)) {
            return [$emptyRow];
        }

        $rows = collect($value)
            ->map(fn (mixed $row): array => array_replace($emptyRow, is_array($row) ? $row : []))
            ->values()
            ->all();

        return $rows === [] ? [$emptyRow] : $rows;
    };

    $formState = [
        'cardFeatures' => $listValue('card_features'),
        'stats' => $rowValue('stats', ['value' => '', 'label' => '']),
        'overviewParagraphs' => $listValue('overview_paragraphs'),
        'bestFitItems' => $rowValue('best_fit_items', ['title' => '', 'description' => '']),
        'subcategories' => $rowValue('subcategories', ['title' => '', 'description' => '', 'details' => '']),
        'galleryProducts' => $rowValue('gallery_products', ['name' => '', 'image' => '']),
    ];
    $cardImage = old('card_image', $category->card_image);
    $heroImage = old('hero_image', $category->hero_image);
    $imageUrl = fn (?string $path): ?string => $path ? (str_starts_with($path, 'http') ? $path : asset($path)) : null;

    $tabs = [
        ['key' => 'basics', 'label' => 'Basics', 'description' => 'Name, URL, sort order, and publishing state.'],
        ['key' => 'homepage', 'label' => 'Homepage Card', 'description' => 'Card summary, CTA, image, and feature bullets.'],
        ['key' => 'hero', 'label' => 'Hero & Stats', 'description' => 'Detail page hero copy, hero image, and stats.'],
        ['key' => 'detail', 'label' => 'Detail Content', 'description' => 'Overview, best-fit content, and subcategories.'],
        ['key' => 'gallery', 'label' => 'Gallery', 'description' => 'Gallery heading, description, and product cards.'],
        ['key' => 'inquiry', 'label' => 'Inquiry', 'description' => 'Final inquiry block and button labels.'],
        ['key' => 'seo', 'label' => 'SEO', 'description' => 'Optional search title and description.'],
    ];

    $errorFieldsByTab = [
        'basics' => ['name', 'slug', 'card_label', 'title', 'sort_order', 'is_published'],
        'homepage' => ['summary', 'card_cta_label', 'card_image', 'card_image_upload', 'card_features', 'card_features.*'],
        'hero' => ['hero_badge', 'hero_image', 'hero_image_upload', 'hero_title', 'hero_highlight', 'hero_description', 'stats', 'stats.*.value', 'stats.*.label'],
        'detail' => ['overview_eyebrow', 'overview_title', 'overview_paragraphs', 'overview_paragraphs.*', 'best_fit_eyebrow', 'best_fit_items', 'best_fit_items.*.title', 'best_fit_items.*.description', 'subcategory_eyebrow', 'subcategory_title', 'subcategory_description', 'subcategories', 'subcategories.*.title', 'subcategories.*.description', 'subcategories.*.details'],
        'gallery' => ['gallery_eyebrow', 'gallery_title', 'gallery_description', 'gallery_products', 'gallery_products.*.name', 'gallery_products.*.image', 'gallery_product_images', 'gallery_product_images.*'],
        'inquiry' => ['inquiry_eyebrow', 'inquiry_title', 'inquiry_description', 'quote_button_label', 'whatsapp_button_label'],
        'seo' => ['seo_title', 'seo_description'],
    ];

    $activeTab = 'basics';

    foreach ($errorFieldsByTab as $tabKey => $fields) {
        foreach ($fields as $field) {
            if ($errors->has($field)) {
                $activeTab = $tabKey;
                break 2;
            }
        }
    }
@endphp

<form
    method="POST"
    action="{{ $action }}"
    enctype="multipart/form-data"
    class="space-y-6"
    x-data="{
        activeTab: {{ Illuminate\Support\Js::from($activeTab) }},
        cardFeatures: {{ Illuminate\Support\Js::from($formState['cardFeatures']) }},
        stats: {{ Illuminate\Support\Js::from($formState['stats']) }},
        overviewParagraphs: {{ Illuminate\Support\Js::from($formState['overviewParagraphs']) }},
        bestFitItems: {{ Illuminate\Support\Js::from($formState['bestFitItems']) }},
        subcategories: {{ Illuminate\Support\Js::from($formState['subcategories']) }},
        galleryProducts: {{ Illuminate\Support\Js::from($formState['galleryProducts']) }},
        addString(collection) {
            this[collection].push('');
        },
        removeString(collection, index) {
            this[collection].splice(index, 1);

            if (this[collection].length === 0) {
                this[collection].push('');
            }
        },
        addRow(collection, row) {
            this[collection].push({ ...row });
        },
        removeRow(collection, index, row) {
            this[collection].splice(index, 1);

            if (this[collection].length === 0) {
                this[collection].push({ ...row });
            }
        },
    }"
>
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="rounded-lg border border-neutral-200 bg-neutral-50 p-2">
        <div class="flex gap-2 overflow-x-auto" role="tablist" aria-label="Category form sections">
            @foreach ($tabs as $tab)
                <button
                    type="button"
                    role="tab"
                    :aria-selected="activeTab === '{{ $tab['key'] }}'"
                    x-on:click="activeTab = '{{ $tab['key'] }}'"
                    :class="activeTab === '{{ $tab['key'] }}' ? 'bg-white text-neutral-950 shadow-sm' : 'text-neutral-500 hover:text-neutral-950'"
                    class="{{ $tabButtonClass }}"
                >
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="rounded-lg border border-neutral-200 bg-white p-4">
        @foreach ($tabs as $tab)
            <div x-show="activeTab === '{{ $tab['key'] }}'" x-cloak>
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-neutral-500">{{ $tab['label'] }}</p>
                <p class="mt-1 text-sm text-neutral-600">{{ $tab['description'] }}</p>
            </div>
        @endforeach
    </div>

    <section x-show="activeTab === 'basics'" x-cloak class="{{ $sectionClass }}" role="tabpanel">
        <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label for="name" class="{{ $labelClass }}">Category Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $category->name) }}" class="{{ $inputClass }}" :required="activeTab === 'basics'">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <label for="slug" class="{{ $labelClass }}">URL Slug</label>
            <input id="slug" name="slug" type="text" value="{{ old('slug', $category->slug) }}" class="{{ $inputClass }}" :required="activeTab === 'basics'">
            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
        </div>
        <div>
            <label for="card_label" class="{{ $labelClass }}">Card Label</label>
            <input id="card_label" name="card_label" type="text" value="{{ old('card_label', $category->card_label) }}" class="{{ $inputClass }}" :required="activeTab === 'basics'">
            <x-input-error :messages="$errors->get('card_label')" class="mt-2" />
        </div>
        <div>
            <label for="title" class="{{ $labelClass }}">Detail Title</label>
            <input id="title" name="title" type="text" value="{{ old('title', $category->title) }}" class="{{ $inputClass }}" :required="activeTab === 'basics'">
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div>
            <label for="sort_order" class="{{ $labelClass }}">Sort Order</label>
            <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="{{ $inputClass }}" :required="activeTab === 'basics'">
            <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
        </div>
        <div class="flex items-end">
            <label class="inline-flex items-center gap-3 text-sm font-semibold text-neutral-700">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" class="border-neutral-400 bg-white text-neutral-950 focus:ring-black" @checked(old('is_published', $category->is_published ?? true))>
                Published on website
            </label>
        </div>
    </div>
    </section>

    <section x-show="activeTab === 'homepage'" x-cloak class="{{ $sectionClass }}" role="tabpanel">
    <div>
        <label for="summary" class="{{ $labelClass }}">Homepage Card Summary</label>
        <textarea id="summary" name="summary" rows="3" class="{{ $inputClass }}" :required="activeTab === 'homepage'">{{ old('summary', $category->summary) }}</textarea>
        <x-input-error :messages="$errors->get('summary')" class="mt-2" />
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label for="card_cta_label" class="{{ $labelClass }}">Card Button Label</label>
            <input id="card_cta_label" name="card_cta_label" type="text" value="{{ old('card_cta_label', $category->card_cta_label) }}" class="{{ $inputClass }}" :required="activeTab === 'homepage'">
            <x-input-error :messages="$errors->get('card_cta_label')" class="mt-2" />
        </div>
        <div>
            <label for="card_image_upload" class="{{ $labelClass }}">Card Image</label>
            <input type="hidden" name="card_image" value="{{ $cardImage }}">
            <input id="card_image_upload" name="card_image_upload" type="file" accept="image/*" class="{{ $fileInputClass }}">
            @if ($imageUrl($cardImage))
                <img src="{{ $imageUrl($cardImage) }}" alt="Current card image" class="mt-3 h-24 w-40 rounded-md border border-neutral-200 object-cover">
            @else
                <p class="mt-2 text-xs text-neutral-500">Optional. Upload a homepage card image.</p>
            @endif
            <x-input-error :messages="$errors->get('card_image')" class="mt-2" />
            <x-input-error :messages="$errors->get('card_image_upload')" class="mt-2" />
        </div>
    </div>

    <div>
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h3 class="text-sm font-semibold uppercase tracking-[0.12em] text-neutral-950">Homepage Card Features</h3>
            <button type="button" class="{{ $smallButtonClass }}" x-on:click="addString('cardFeatures')">Add Feature</button>
        </div>
        <div class="mt-4 space-y-3">
            <template x-for="(feature, index) in cardFeatures" :key="index">
                <div class="flex gap-3">
                    <input type="text" :name="'card_features[' + index + ']'" x-model="cardFeatures[index]" class="{{ $inputClass }}" placeholder="Example: Game jerseys, shorts, warm-up sets">
                    <button type="button" class="{{ $smallButtonClass }} shrink-0" x-on:click="removeString('cardFeatures', index)">Remove</button>
                </div>
            </template>
        </div>
        <x-input-error :messages="$errors->get('card_features')" class="mt-2" />
        <x-input-error :messages="$errors->get('card_features.*')" class="mt-2" />
    </div>
    </section>

    <section x-show="activeTab === 'hero'" x-cloak class="{{ $sectionClass }}" role="tabpanel">
        <h3 class="text-sm font-semibold uppercase tracking-[0.12em] text-neutral-950">Hero & Stats</h3>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div>
                <label for="hero_badge" class="{{ $labelClass }}">Hero Badge</label>
                <input id="hero_badge" name="hero_badge" type="text" value="{{ old('hero_badge', $category->hero_badge) }}" class="{{ $inputClass }}" :required="activeTab === 'hero'">
                <x-input-error :messages="$errors->get('hero_badge')" class="mt-2" />
            </div>
            <div>
                <label for="hero_image_upload" class="{{ $labelClass }}">Hero Image</label>
                <input type="hidden" name="hero_image" value="{{ $heroImage }}">
                <input id="hero_image_upload" name="hero_image_upload" type="file" accept="image/*" class="{{ $fileInputClass }}">
                @if ($imageUrl($heroImage))
                    <img src="{{ $imageUrl($heroImage) }}" alt="Current hero image" class="mt-3 h-24 w-40 rounded-md border border-neutral-200 object-cover">
                @else
                    <p class="mt-2 text-xs text-neutral-500">Optional. Upload a detail-page hero image.</p>
                @endif
                <x-input-error :messages="$errors->get('hero_image')" class="mt-2" />
                <x-input-error :messages="$errors->get('hero_image_upload')" class="mt-2" />
            </div>
            <div>
                <label for="hero_title" class="{{ $labelClass }}">Hero Title</label>
                <input id="hero_title" name="hero_title" type="text" value="{{ old('hero_title', $category->hero_title) }}" class="{{ $inputClass }}" :required="activeTab === 'hero'">
                <x-input-error :messages="$errors->get('hero_title')" class="mt-2" />
            </div>
            <div>
                <label for="hero_highlight" class="{{ $labelClass }}">Hero Highlight</label>
                <input id="hero_highlight" name="hero_highlight" type="text" value="{{ old('hero_highlight', $category->hero_highlight) }}" class="{{ $inputClass }}">
                <x-input-error :messages="$errors->get('hero_highlight')" class="mt-2" />
            </div>
        </div>
        <div class="mt-4">
            <label for="hero_description" class="{{ $labelClass }}">Hero Description</label>
            <textarea id="hero_description" name="hero_description" rows="3" class="{{ $inputClass }}" :required="activeTab === 'hero'">{{ old('hero_description', $category->hero_description) }}</textarea>
            <x-input-error :messages="$errors->get('hero_description')" class="mt-2" />
        </div>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h4 class="text-xs font-semibold uppercase tracking-[0.12em] text-neutral-600">Stats</h4>
            <button type="button" class="{{ $smallButtonClass }}" x-on:click="addRow('stats', { value: '', label: '' })">Add Stat</button>
        </div>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <template x-for="(stat, index) in stats" :key="index">
                <div class="{{ $repeaterPanelClass }}">
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label class="{{ $labelClass }}">Value</label>
                            <input type="text" :name="'stats[' + index + '][value]'" x-model="stat.value" class="{{ $inputClass }}" placeholder="Low MOQ">
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Label</label>
                            <input type="text" :name="'stats[' + index + '][label]'" x-model="stat.label" class="{{ $inputClass }}" placeholder="Flexible Bulk Programs">
                        </div>
                    </div>
                    <button type="button" class="{{ $smallButtonClass }} mt-3" x-on:click="removeRow('stats', index, { value: '', label: '' })">Remove Stat</button>
                </div>
            </template>
        </div>
        <x-input-error :messages="$errors->get('stats')" class="mt-2" />
        <x-input-error :messages="$errors->get('stats.*.value')" class="mt-2" />
        <x-input-error :messages="$errors->get('stats.*.label')" class="mt-2" />
    </section>

    <section x-show="activeTab === 'detail'" x-cloak class="{{ $sectionClass }}" role="tabpanel">
        <h3 class="text-sm font-semibold uppercase tracking-[0.12em] text-neutral-950">Detail Sections</h3>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div>
                <label for="overview_eyebrow" class="{{ $labelClass }}">Overview Eyebrow</label>
                <input id="overview_eyebrow" name="overview_eyebrow" type="text" value="{{ old('overview_eyebrow', $category->overview_eyebrow) }}" class="{{ $inputClass }}" :required="activeTab === 'detail'">
                <x-input-error :messages="$errors->get('overview_eyebrow')" class="mt-2" />
            </div>
            <div>
                <label for="overview_title" class="{{ $labelClass }}">Overview Title</label>
                <input id="overview_title" name="overview_title" type="text" value="{{ old('overview_title', $category->overview_title) }}" class="{{ $inputClass }}" :required="activeTab === 'detail'">
                <x-input-error :messages="$errors->get('overview_title')" class="mt-2" />
            </div>
            <div>
                <label for="best_fit_eyebrow" class="{{ $labelClass }}">Best Fit Eyebrow</label>
                <input id="best_fit_eyebrow" name="best_fit_eyebrow" type="text" value="{{ old('best_fit_eyebrow', $category->best_fit_eyebrow) }}" class="{{ $inputClass }}" :required="activeTab === 'detail'">
                <x-input-error :messages="$errors->get('best_fit_eyebrow')" class="mt-2" />
            </div>
            <div>
                <label for="subcategory_eyebrow" class="{{ $labelClass }}">Subcategory Eyebrow</label>
                <input id="subcategory_eyebrow" name="subcategory_eyebrow" type="text" value="{{ old('subcategory_eyebrow', $category->subcategory_eyebrow) }}" class="{{ $inputClass }}" :required="activeTab === 'detail'">
                <x-input-error :messages="$errors->get('subcategory_eyebrow')" class="mt-2" />
            </div>
            <div>
                <label for="subcategory_title" class="{{ $labelClass }}">Subcategory Title</label>
                <input id="subcategory_title" name="subcategory_title" type="text" value="{{ old('subcategory_title', $category->subcategory_title) }}" class="{{ $inputClass }}" :required="activeTab === 'detail'">
                <x-input-error :messages="$errors->get('subcategory_title')" class="mt-2" />
            </div>
        </div>
        <div class="mt-4">
            <label for="subcategory_description" class="{{ $labelClass }}">Subcategory Description</label>
            <textarea id="subcategory_description" name="subcategory_description" rows="3" class="{{ $inputClass }}" :required="activeTab === 'detail'">{{ old('subcategory_description', $category->subcategory_description) }}</textarea>
            <x-input-error :messages="$errors->get('subcategory_description')" class="mt-2" />
        </div>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h4 class="text-xs font-semibold uppercase tracking-[0.12em] text-neutral-600">Overview Paragraphs</h4>
            <button type="button" class="{{ $smallButtonClass }}" x-on:click="addString('overviewParagraphs')">Add Paragraph</button>
        </div>
        <div class="mt-4 space-y-3">
            <template x-for="(paragraph, index) in overviewParagraphs" :key="index">
                <div class="flex gap-3">
                    <textarea :name="'overview_paragraphs[' + index + ']'" x-model="overviewParagraphs[index]" rows="3" class="{{ $inputClass }}" placeholder="Overview paragraph"></textarea>
                    <button type="button" class="{{ $smallButtonClass }} h-10 shrink-0" x-on:click="removeString('overviewParagraphs', index)">Remove</button>
                </div>
            </template>
        </div>
        <x-input-error :messages="$errors->get('overview_paragraphs')" class="mt-2" />
        <x-input-error :messages="$errors->get('overview_paragraphs.*')" class="mt-2" />

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h4 class="text-xs font-semibold uppercase tracking-[0.12em] text-neutral-600">Best Fit Items</h4>
            <button type="button" class="{{ $smallButtonClass }}" x-on:click="addRow('bestFitItems', { title: '', description: '' })">Add Item</button>
        </div>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <template x-for="(item, index) in bestFitItems" :key="index">
                <div class="{{ $repeaterPanelClass }}">
                    <label class="{{ $labelClass }}">Title</label>
                    <input type="text" :name="'best_fit_items[' + index + '][title]'" x-model="item.title" class="{{ $inputClass }}" placeholder="Sports Clubs & Academies">
                    <label class="{{ $labelClass }} mt-3">Description</label>
                    <textarea :name="'best_fit_items[' + index + '][description]'" x-model="item.description" rows="3" class="{{ $inputClass }}" placeholder="Seasonal uniform programs and sponsor-ready branding."></textarea>
                    <button type="button" class="{{ $smallButtonClass }} mt-3" x-on:click="removeRow('bestFitItems', index, { title: '', description: '' })">Remove Item</button>
                </div>
            </template>
        </div>
        <x-input-error :messages="$errors->get('best_fit_items')" class="mt-2" />
        <x-input-error :messages="$errors->get('best_fit_items.*.title')" class="mt-2" />
        <x-input-error :messages="$errors->get('best_fit_items.*.description')" class="mt-2" />

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h4 class="text-xs font-semibold uppercase tracking-[0.12em] text-neutral-600">Subcategories</h4>
            <button type="button" class="{{ $smallButtonClass }}" x-on:click="addRow('subcategories', { title: '', description: '', details: '' })">Add Subcategory</button>
        </div>
        <div class="mt-4 space-y-4">
            <template x-for="(subcategory, index) in subcategories" :key="index">
                <div class="{{ $repeaterPanelClass }}">
                    <div class="grid gap-3 md:grid-cols-2">
                        <div>
                            <label class="{{ $labelClass }}">Title</label>
                            <input type="text" :name="'subcategories[' + index + '][title]'" x-model="subcategory.title" class="{{ $inputClass }}" placeholder="Basketball">
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Details</label>
                            <input type="text" :name="'subcategories[' + index + '][details]'" x-model="subcategory.details" class="{{ $inputClass }}" placeholder="Jerseys, shorts, warm-up sets">
                        </div>
                    </div>
                    <label class="{{ $labelClass }} mt-3">Description</label>
                    <textarea :name="'subcategories[' + index + '][description]'" x-model="subcategory.description" rows="3" class="{{ $inputClass }}" placeholder="Short buyer-facing description"></textarea>
                    <button type="button" class="{{ $smallButtonClass }} mt-3" x-on:click="removeRow('subcategories', index, { title: '', description: '', details: '' })">Remove Subcategory</button>
                </div>
            </template>
        </div>
        <x-input-error :messages="$errors->get('subcategories')" class="mt-2" />
        <x-input-error :messages="$errors->get('subcategories.*.title')" class="mt-2" />
        <x-input-error :messages="$errors->get('subcategories.*.description')" class="mt-2" />
        <x-input-error :messages="$errors->get('subcategories.*.details')" class="mt-2" />

    </section>

    <section x-show="activeTab === 'gallery'" x-cloak class="{{ $sectionClass }}" role="tabpanel">
        <h3 class="text-sm font-semibold uppercase tracking-[0.12em] text-neutral-950">Gallery</h3>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label for="gallery_eyebrow" class="{{ $labelClass }}">Gallery Eyebrow</label>
                <input id="gallery_eyebrow" name="gallery_eyebrow" type="text" value="{{ old('gallery_eyebrow', $category->gallery_eyebrow) }}" class="{{ $inputClass }}" :required="activeTab === 'gallery'">
                <x-input-error :messages="$errors->get('gallery_eyebrow')" class="mt-2" />
            </div>
            <div>
                <label for="gallery_title" class="{{ $labelClass }}">Gallery Title</label>
                <input id="gallery_title" name="gallery_title" type="text" value="{{ old('gallery_title', $category->gallery_title) }}" class="{{ $inputClass }}" :required="activeTab === 'gallery'">
                <x-input-error :messages="$errors->get('gallery_title')" class="mt-2" />
            </div>
            <div>
                <label for="gallery_description" class="{{ $labelClass }}">Gallery Description</label>
                <textarea id="gallery_description" name="gallery_description" rows="3" class="{{ $inputClass }}" :required="activeTab === 'gallery'">{{ old('gallery_description', $category->gallery_description) }}</textarea>
                <x-input-error :messages="$errors->get('gallery_description')" class="mt-2" />
            </div>
        </div>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h4 class="text-xs font-semibold uppercase tracking-[0.12em] text-neutral-600">Gallery Products</h4>
            <button type="button" class="{{ $smallButtonClass }}" x-on:click="addRow('galleryProducts', { name: '', image: '' })">Add Product</button>
        </div>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <template x-for="(product, index) in galleryProducts" :key="index">
                <div class="{{ $repeaterPanelClass }}">
                    <label class="{{ $labelClass }}">Product Name</label>
                    <input type="text" :name="'gallery_products[' + index + '][name]'" x-model="product.name" class="{{ $inputClass }}" placeholder="American Football Uniforms">
                    <label class="{{ $labelClass }} mt-3">Product Image</label>
                    <input type="hidden" :name="'gallery_products[' + index + '][image]'" x-model="product.image">
                    <input type="file" :name="'gallery_product_images[' + index + ']'" accept="image/*" class="{{ $fileInputClass }}">
                    <img
                        x-show="product.image"
                        :src="product.image.startsWith('http') ? product.image : '/' + product.image"
                        alt="Current product image"
                        class="mt-3 h-24 w-40 rounded-md border border-neutral-200 object-cover"
                    >
                    <button type="button" class="{{ $smallButtonClass }} mt-3" x-on:click="removeRow('galleryProducts', index, { name: '', image: '' })">Remove Product</button>
                </div>
            </template>
        </div>
        <x-input-error :messages="$errors->get('gallery_products')" class="mt-2" />
        <x-input-error :messages="$errors->get('gallery_products.*.name')" class="mt-2" />
        <x-input-error :messages="$errors->get('gallery_products.*.image')" class="mt-2" />
        <x-input-error :messages="$errors->get('gallery_product_images')" class="mt-2" />
        <x-input-error :messages="$errors->get('gallery_product_images.*')" class="mt-2" />
    </section>

    <section x-show="activeTab === 'inquiry'" x-cloak class="{{ $sectionClass }}" role="tabpanel">
        <h3 class="text-sm font-semibold uppercase tracking-[0.12em] text-neutral-950">Inquiry</h3>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div>
                <label for="inquiry_eyebrow" class="{{ $labelClass }}">Inquiry Eyebrow</label>
                <input id="inquiry_eyebrow" name="inquiry_eyebrow" type="text" value="{{ old('inquiry_eyebrow', $category->inquiry_eyebrow) }}" class="{{ $inputClass }}" :required="activeTab === 'inquiry'">
                <x-input-error :messages="$errors->get('inquiry_eyebrow')" class="mt-2" />
            </div>
            <div>
                <label for="inquiry_title" class="{{ $labelClass }}">Inquiry Title</label>
                <input id="inquiry_title" name="inquiry_title" type="text" value="{{ old('inquiry_title', $category->inquiry_title) }}" class="{{ $inputClass }}" :required="activeTab === 'inquiry'">
                <x-input-error :messages="$errors->get('inquiry_title')" class="mt-2" />
            </div>
            <div>
                <label for="quote_button_label" class="{{ $labelClass }}">Quote Button Label</label>
                <input id="quote_button_label" name="quote_button_label" type="text" value="{{ old('quote_button_label', $category->quote_button_label) }}" class="{{ $inputClass }}" :required="activeTab === 'inquiry'">
                <x-input-error :messages="$errors->get('quote_button_label')" class="mt-2" />
            </div>
            <div>
                <label for="whatsapp_button_label" class="{{ $labelClass }}">WhatsApp Button Label</label>
                <input id="whatsapp_button_label" name="whatsapp_button_label" type="text" value="{{ old('whatsapp_button_label', $category->whatsapp_button_label) }}" class="{{ $inputClass }}" :required="activeTab === 'inquiry'">
                <x-input-error :messages="$errors->get('whatsapp_button_label')" class="mt-2" />
            </div>
        </div>
        <div class="mt-4">
            <label for="inquiry_description" class="{{ $labelClass }}">Inquiry Description</label>
            <textarea id="inquiry_description" name="inquiry_description" rows="3" class="{{ $inputClass }}" :required="activeTab === 'inquiry'">{{ old('inquiry_description', $category->inquiry_description) }}</textarea>
            <x-input-error :messages="$errors->get('inquiry_description')" class="mt-2" />
        </div>
    </section>

    <section x-show="activeTab === 'seo'" x-cloak class="{{ $sectionClass }}" role="tabpanel">
        <h3 class="text-sm font-semibold uppercase tracking-[0.12em] text-neutral-950">SEO</h3>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label for="seo_title" class="{{ $labelClass }}">SEO Title</label>
                <input id="seo_title" name="seo_title" type="text" value="{{ old('seo_title', $category->seo_title) }}" class="{{ $inputClass }}">
                <x-input-error :messages="$errors->get('seo_title')" class="mt-2" />
            </div>
            <div>
                <label for="seo_description" class="{{ $labelClass }}">SEO Description</label>
                <textarea id="seo_description" name="seo_description" rows="3" class="{{ $inputClass }}">{{ old('seo_description', $category->seo_description) }}</textarea>
                <x-input-error :messages="$errors->get('seo_description')" class="mt-2" />
            </div>
        </div>
    </section>

    <div class="flex justify-end gap-3 border-t border-neutral-200 pt-6">
        <a href="{{ route('admin.categories.index') }}" class="rounded-md border border-neutral-300 px-4 py-2 text-sm font-semibold text-neutral-600 transition hover:border-black hover:text-neutral-950">
            Cancel
        </a>
        <button type="submit" class="rounded-md bg-black px-4 py-2 text-sm font-semibold text-white transition hover:bg-neutral-800">
            {{ $submitLabel }}
        </button>
    </div>
</form>
