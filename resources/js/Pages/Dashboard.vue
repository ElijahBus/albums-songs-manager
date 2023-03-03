<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="mx-auto grid grid-cols-12 max-w-4xl gap-4 bg-zinc-50 p-1">
                <div class="header col-span-12 rounded-lg border border-gray-700 bg-gray-700 py-8">
                    <!-- Albums -->
                    <div class="flex flex-col">
                        <div class="flex items-center">
                            <h2 class="font-bold text-lg mx-2 text-white">Albums</h2>
                            <Link :href="route('albums.create')" class="bg-gray-900 p-2 rounded-full text-white">Create a new album</Link>
                        </div>

                        <div class="mt-3 mx-2 flex">
                            <div class="album-card w-1/4 bg-gray-900 rounded flex flex-col items-center p-2 mr-2"
                                 v-for="(album, index) in albums"
                                 :key="index"
                            >
                                <img :src="album.cover_image" alt=""
                                     class="h-16 w-full object-cover rounded">
                                <div class="album-details mt-1">
                                    <em class="text-white text-sm">{{ album.title }}</em>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-span-12 rounded-lg border border-gray-500 bg-gray-200 p-32 sm:col-span-8">
                    <!-- Songs -->
                </div>


                <div class="col-span-12 rounded-lg border border-gray-400 bg-gray-200 p-16 sm:col-span-4">
                    <!-- Genres -->
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


export default {
    props: ['albums'],
    components: {AuthenticatedLayout, Head, Link}
}

</script>

