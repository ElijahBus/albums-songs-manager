<template>
    <form @submit.prevent="submitForm" method="post" enctype="multipart/form-data"
          class="bg-white rounded px-8 pt-6 pb-8 mb-4 w-1/2 flex flex-col my-2">
        <div class=" flex flex-col items-center mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
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
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                       for="description">
                    Description
                </label>
                <input
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                    id="description"
                    type="text"
                    v-model="form.description"
                >
            </div>

            <div class="w-full px-3 mt-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                       for="release-date">
                    Release date
                </label>
                <input
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                    id="release-date"
                    type="date"
                    v-model="form.release_date"
                >
            </div>

            <div class="w-full px-3 mt-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                       for="cover-image">
                    Cover image
                </label>
                <input
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                    id="cover-image"
                    type="file"
                    accept="image/jpeg, image/png"
                    @input="appendCoverImageToFormData"
                >
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

export default {
    name: "AlbumForm",
    components: {Link},

    setup() {
        const form = useForm({
            title: '',
            description: '',
            release_date: null,
            cover_image: null
        });

        const appendCoverImageToFormData = (event) => {
            form.cover_image = event.target.files[0]
        }

        const submitForm = () => {
            form.post(route('albums.store'));
        }

        return {form, appendCoverImageToFormData, submitForm};
    }
}
</script>

<style scoped>

</style>