<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                            ? 'inline-flex items-center px-1 pt-1 border-b-2  text-sm font-medium leading-5 text-white focus:outline-none transition duration-150 ease-in-out'
                            : 'inline-flex items-center border-b-2 border-transparent font-medium leading-5 text-white font-bold bg-gray-600 rounded border-b-2  hover:bg-cyan-700 uppercase text-xs hover:text-white shadow-md py-2 px-6 inline-flex items-center focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
            }
        }
    }
</script>
