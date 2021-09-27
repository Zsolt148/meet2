<template>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 my-12">
        <div class="text-2xl text-green dark:text-green-light">
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-700 shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
