<template>
    <Head title="Create New Album" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="flex flex-col items-center max-w-full">
                <div class="w-1/2 bg-gray-700 text-center py-2 rounded-full">
                    <h3 class="text-white font-bold">Edit song</h3>
                </div>

                <SongForm :albums="albums" :genres="genres" :song="song"></SongForm>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import SongForm from "@/Pages/Partials/SongForm.vue";


export default {
    name: 'EditSong',
    components: {SongForm, AuthenticatedLayout, Head, Link},
    props: ['genres', 'albums', 'song'],

}

</script>

