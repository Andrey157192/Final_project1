<<<<<<< HEAD
@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white', 'dropdownClasses' => ''])
=======
@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])
>>>>>>> main

@php
switch ($align) {
    case 'left':
<<<<<<< HEAD
        $alignmentClasses = 'origin-top-left left-0';
=======
        $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
>>>>>>> main
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
<<<<<<< HEAD
    case 'none':
    case 'false':
        $alignmentClasses = '';
        break;
    case 'right':
    default:
        $alignmentClasses = 'origin-top-right right-0';
=======
    case 'right':
    default:
        $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
>>>>>>> main
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp

<<<<<<< HEAD
<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
=======
<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
>>>>>>> main
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
<<<<<<< HEAD
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }} {{ $dropdownClasses }}"
=======
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
>>>>>>> main
            style="display: none;"
            @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
