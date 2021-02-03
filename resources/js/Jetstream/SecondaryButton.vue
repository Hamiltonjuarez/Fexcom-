<template>
    <button :type="type" class="inline-flex items-center  text-sm py-2 px-6 text-white font-bold bg-gray-400 rounded border-b-2  hover:bg-gray-500  text-xs hover:text-white shadow-md inline-flex items-center focus:outline-none focus:text-gray-700 focus:border-gray-300 uppercase transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    }
</script>
