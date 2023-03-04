<template>
    <Head title="Create New Album" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="flex flex-col items-center max-w-full">
                <div class="w-1/2 bg-gray-700 text-center py-2 rounded-full">
                    <h3 class="text-white font-bold">Edit album</h3>
                </div>

                <AlbumForm :album="album"></AlbumForm>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import AlbumForm from "@/Pages/Partials/AlbumForm.vue";


export default {
    name: 'EditAlbum',
    components: {AlbumForm, AuthenticatedLayout, Head, Link},
    props: ['album']
}

</script>

