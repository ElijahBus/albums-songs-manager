<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="mx-auto grid grid-cols-12 max-w-6xl gap-4  p-1">
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
                            <Link :href="route('albums.show', album.id)" class="album-card bg-gray-800 hover:bg-gray-900 rounded flex flex-col items-center p-2 mr-2"
                                 style="width: 250px; min-width: 250px; max-height: 180px; overflow-y: scroll;"
                                 v-for="(album, index) in albums?.data"
                                 :key="index"
                            >
                                <!-- Cover image -->
                                <img :src="album.cover_image" alt=""
                                     class="h-16 w-full object-cover rounded">
                                <!-- Title -->
                                <div class="album-details mt-1">
                                    <em class="text-white text-sm">{{ album.title }}</em>
                                </div>
                                <!-- Actions -->
                                <div class="w-full items-end mt-2 flex-1 flex justify-end">
                                    <div class="flex justify-evenly items-center bg-gray-700 rounded px-3 py-1" style="width: 100px; height: 25px;">
                                        <Link :href="route('albums.edit', album.id)" class="text-indigo-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 96 960 960" width="16"><path d="M180 876h44l443-443-44-44-443 443v44Zm614-486L666 262l41.823-41.823Q725 203 750.5 203.5T793 221l43 43q17 17 17 42t-16.963 41.963L794 390ZM150.327 936q-12.889 0-21.608-8.714Q120 918.571 120 905.689v-85.627Q120 814 122 809q2-5 7-10l495-495 128 128-495 495q-5 5-10.217 7-5.218 2-10.783 2h-85.673ZM645 411l-22-22 44 44-22-22Z"/></svg>

                                        </Link>

                                        <span> / </span>

                                        <form @submit.prevent="deleteAlbum(album.id)" method="post">
                                            <button type="submit" class="text-red-700 ml-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 96 960 960" width="16"><path d="M261 936q-24 0-42-18t-18-42V306h-11q-12.75 0-21.375-8.675-8.625-8.676-8.625-21.5 0-12.825 8.625-21.325T190 246h158q0-13 8.625-21.5T378 216h204q12.75 0 21.375 8.625T612 246h158q12.75 0 21.375 8.675 8.625 8.676 8.625 21.5 0 12.825-8.625 21.325T770 306h-11v570q0 24-18 42t-42 18H261Zm0-630v570h438V306H261Zm106 454q0 12.75 8.675 21.375 8.676 8.625 21.5 8.625 12.825 0 21.325-8.625T427 760V421q0-12.75-8.675-21.375-8.676-8.625-21.5-8.625-12.825 0-21.325 8.625T367 421v339Zm166 0q0 12.75 8.675 21.375 8.676 8.625 21.5 8.625 12.825 0 21.325-8.625T593 760V421q0-12.75-8.675-21.375-8.676-8.625-21.5-8.625-12.825 0-21.325 8.625T533 421v339ZM261 306v570-570Z"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </Link>

                        </div>
                    </div>
                </div>


                <div class="col-span-12 rounded-lg bg-gray-700 py-10 px-4 sm:col-span-9">
                    <!-- Songs -->

                    <div class="flex items-center justify-between">
                        <h2 v-if="filtered_album" class="text-lg font-bold text-white">All Songs in the album: ' {{ filtered_album }} '</h2>
                        <h2 v-else-if="filtered_genre" class="text-lg font-bold text-white">All Songs in the genre: ' {{ filtered_genre }} '</h2>
                        <h2 v-else class="text-lg font-bold text-white">All Songs</h2>

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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-gray-500 bg-gray-600 text-sm"
                            v-for="(song, index) in songs?.data"
                            :key="index"
                        >
                            <td>{{ index+1 }}</td>
                            <td>{{ song.title }}</td>
                            <td>{{ secondsToMinutesConverter(song.length) }}</td>
                            <td>{{ song.genre }}</td>
                            <td>{{ song?.album?.title || filtered_album }}</td>
                            <td class="flex items-center justify-evenly px-3 bg-gray-400 py-1" style="min-width: 100px;">
                                <Link :href="route('songs.edit', song.id)" class="text-indigo-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 96 960 960" width="16"><path d="M180 876h44l443-443-44-44-443 443v44Zm614-486L666 262l41.823-41.823Q725 203 750.5 203.5T793 221l43 43q17 17 17 42t-16.963 41.963L794 390ZM150.327 936q-12.889 0-21.608-8.714Q120 918.571 120 905.689v-85.627Q120 814 122 809q2-5 7-10l495-495 128 128-495 495q-5 5-10.217 7-5.218 2-10.783 2h-85.673ZM645 411l-22-22 44 44-22-22Z"/></svg>

                                </Link>

                                <span> / </span>

                                <form @submit.prevent="deleteSong(song.id)" method="post">
                                    <button type="submit" class="text-red-700 ml-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 96 960 960" width="16"><path d="M261 936q-24 0-42-18t-18-42V306h-11q-12.75 0-21.375-8.675-8.625-8.676-8.625-21.5 0-12.825 8.625-21.325T190 246h158q0-13 8.625-21.5T378 216h204q12.75 0 21.375 8.625T612 246h158q12.75 0 21.375 8.675 8.625 8.676 8.625 21.5 0 12.825-8.625 21.325T770 306h-11v570q0 24-18 42t-42 18H261Zm0-630v570h438V306H261Zm106 454q0 12.75 8.675 21.375 8.676 8.625 21.5 8.625 12.825 0 21.325-8.625T427 760V421q0-12.75-8.675-21.375-8.676-8.625-21.5-8.625-12.825 0-21.325 8.625T367 421v339Zm166 0q0 12.75 8.675 21.375 8.676 8.625 21.5 8.625 12.825 0 21.325-8.625T593 760V421q0-12.75-8.675-21.375-8.676-8.625-21.5-8.625-12.825 0-21.325 8.625T533 421v339ZM261 306v570-570Z"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>


                <div class="col-span-12 rounded-lg bg-gray-700 p-10 sm:col-span-3">
                    <!-- Genres -->
                    <h2 class="text-lg font-bold text-white">All Genres</h2>

                    <div class="genres flex flex-col">
                        <Link
                            :href="route('genres.show', genre.id)"
                            v-for="(genre, index) in genres?.data"
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
import {Head, Link, router} from '@inertiajs/vue3';


export default {
    props: ['albums', 'genres', 'songs', 'filtered_album', 'filtered_genre'],
    components: {AuthenticatedLayout, Head, Link},

    setup() {
        const deleteSong = (id) => {
            router.delete(route('songs.destroy', id));
        }

        const deleteAlbum = (id) => {
            router.delete(route('albums.destroy', id));
        }

        const secondsToMinutesConverter = (secs) => {
            if (!secs) return;

            if (secs < 60 ) return secs + ' secs';

            if (secs >= 60 ) return Math.round((secs / 60))  + ' mins';
        }

        return {deleteSong, deleteAlbum, secondsToMinutesConverter}
    }
}

</script>

