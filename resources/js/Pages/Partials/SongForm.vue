<template>
    <form @submit.prevent="submitForm" method="post"
          class="bg-white rounded px-8 pt-6 pb-8 mb-4 w-1/2 flex flex-col my-2">

        <input v-if="song.id" type="hidden" name="_method" value="PUT">
        <div class=" flex flex-col items-center mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="required block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                       for="title">
                    Title
                </label>
                <input
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                    id="title"
                    type="text"
                    v-model="form.title"
                >
            </div>
            <div class="w-full px-3 mt-4">
                <label class="required block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                       for="length">
                    Length
                </label>
                <input
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                    id="length"
                    type="text"
                    v-model="form.length"
                >
            </div>

            <div class="w-full px-3 mt-4">
                <label class="required block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                       for="genre">
                    Genre
                </label>
                <select
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                    id="genre"
                    type="date"
                    v-model="form.genre"
                >
                    <option value="none" selected disabled>Select genre</option>
                    <option v-for="(genre, index) in genres" :key="index" :value="genre.name">{{ genre.name }}</option>
                </select>
            </div>

            <div class="w-full px-3 mt-4">
                <label class="required block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                       for="album">
                    Album
                </label>
                <select
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                    id="album"
                    v-model="form.album_id"

                >
                    <option value="none" selected disabled>Select album</option>
                    <option v-for="(album, index) in albums" :key="index" :value="album.id" class="Album">{{ album.title }}</option>
                </select>
            </div>

            <div class="w-full px-3 mt-4">
                <em v-if="formError" class="text-sm text-red-500">Fill in all required fields</em>
            </div>

            <div class="mt-4 w-full flex justify-center">
                <button type="submit" class="bg-gray-700 py-2 w-1/3 rounded-full text-white mr-1">Save</button>
                <Link :href="route('dashboard')"
                      class="bg-gray-300 py-2 w-1/3 rounded-full text-center text-gray-700">Cancel
                </Link>
            </div>
        </div>
    </form>
</template>

<script>
import {Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";

export default {
    name: "SongForm",
    components: {Link},
    props: ['genres', 'albums', 'song'],

    setup(props) {
        const form = useForm({
            title: props.song?.title,
            length: props.song?.length,
            genre: props.song?.genre,
            album_id: props.song?.album_id
        });

        let formError = ref(false)

        const submitForm = () => {
            if (props.song.hasOwnProperty('id')) {
                form.put(route('songs.update', props.song.id), {
                    onError: error => {
                        formError.value = true;
                    }
                });
                return;
            }

            form.post(route('songs.store'), {
                onError: error => {
                    formError.value = true;
                }
            });
        }

        return {form, formError, submitForm};
    }
}
</script>

<style scoped>

</style>
