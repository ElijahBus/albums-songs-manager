<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, index) in links" :key="index">
                <Link
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded-full hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-gray-900 text-white': link.active }" :href="link.url" v-html="link.label"/>
            </template>
        </div>
    </div>
</template>
<script>

import {Link} from "@inertiajs/vue3";

export default {
    name: 'Pagination',
    props: {
        links: Array
    },
    components: {Link}
}
</script>
