<template>
    <button :type="type" class="inline-flex items-center  text-sm py-2 px-6 text-white font-bold bg-gray-600 rounded border-b-2  hover:bg-cyan-700  text-xs hover:text-white shadow-md inline-flex items-center focus:outline-none focus:text-white focus:border-gray-300 uppercase transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
