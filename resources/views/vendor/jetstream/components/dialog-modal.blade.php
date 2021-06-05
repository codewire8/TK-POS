@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>

    <div class="px-6 py-4">
        <div class="font-semibold">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="px-4 py-2 bg-gray-50 text-right">
        {{ $footer }}
    </div>

</x-jet-modal>
