<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="mx-auto grid grid-cols-12 max-w-4xl gap-4  p-1">
                <div class="header col-span-12 rounded-lg border border-gray-700 bg-gray-700 py-8">
                    <!-- Albums -->
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between px-4">
                            <h2 class="font-bold text-lg text-white">Albums</h2>
                            <Link :href="route('albums.create')" class="bg-gray-900 py-2 px-4 rounded-full text-white">
                                Create a new album
                            </Link>
                        </div>

                        <div class="mt-3 mx-2 flex mt-10 overflow-y-scroll">
                            <div class="album-card bg-gray-800 rounded flex flex-col items-center p-2 mr-2"
                                 style="width: 250px; min-width: 250px;"
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


                <div class="col-span-12 rounded-lg bg-gray-700 py-10 px-4 sm:col-span-8">
                    <!-- Songs -->

                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-white">All Songs</h2>

                        <Link :href="route('songs.create')" class="bg-gray-900 py-2 px-4 rounded-full text-white">
                            Add a new song
                        </Link>
                    </div>
                    <table class="mt-10 table w-full text-center">
                        <thead class="bg-gray-300 border-b">
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Length</th>
                            <th>Genre</th>
                            <th>Album</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-gray-500 bg-gray-600"
                            v-for="(song, index) in songs"
                            :key="index"
                        >
                            <td>{{ song.id }}</td>
                            <td>{{ song.title }}</td>
                            <td>{{ song.length }}</td>
                            <td>{{ song.genre }}</td>
                            <td>{{ song.album.title }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>


                <div class="col-span-12 rounded-lg bg-gray-700 p-10 sm:col-span-4">
                    <!-- Genres -->
                    <h2 class="text-lg font-bold text-white">All Genres</h2>

                    <div class="genres flex flex-col">
                        <Link
                            v-for="(genre, index) in genres"
                            :key="index"
                            class="text-gray-300 ml-3 my-1 hover:bg-gray-900 px-2"
                        >{{ genre.name }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';


export default {
    props: ['albums', 'genres', 'songs'],
    components: {AuthenticatedLayout, Head, Link}
}

</script>

