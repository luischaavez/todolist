<template>
    <on-click-outside :do="hideOptionsBox">
        <div class="p-1 cursor-pointer relative flex justify-between"
            @mouseover="showOptions = true"
            @mouseleave="showOptions = false"
        >
            <div @click="filter" class="">
                <span :class="color" class="text-xs fa fa-circle mr-2"></span>
                {{ attributes.name }}
            </div>

            <div>
                <span class="text-xs float-right pr-1 pt-3px" :class="[showOptions ? 'inline' : 'hidden']" @click="optionsBox = true">
                    <i class="fas fa-ellipsis-v text-grey-dark hover:text-grey-darkest"></i>
                </span>
            </div>

            <div v-if="optionsBox" class="z-30 absolute shadow-md options-box bg-white w-24 text-sm border rounded">
                <div class="px-2 py-1 text-center hover:bg-grey-lighter rounded-t">Edit</div>
                <div @click="destroy" class="px-2 py-1 text-center hover:bg-grey-lighter rounded-b">Remove</div>
            </div>
        </div>
    </on-click-outside> 
</template>

<script>
    import OnClickOutside from './OnClickOutside.vue';

    export default {
        props: ['attributes'],

        components: { OnClickOutside },

        data() {
            return {
                id: this.attributes.id,
                showOptions: false,
                optionsBox: false,
                colors: [
                    'text-indigo', 'text-orange', 'text-red-light', 'text-blue'
                ],
            }
        },

        computed: {
            color() {
                return this.colors[Math.floor(Math.random() * this.colors.length)];
            }
        },

        methods: {
            destroy() {
                axios.delete('/projects/' + this.id);

                flash('Project deleted successfully!');

                this.$emit('deleted', this.id);
            },
            hideOptionsBox() {
                this.optionsBox = false;
            },

            filter() {
                window.events.$emit('filter', {
                   title: this.attributes.name,
                   project: this.attributes.id,
                   url: `${window.location}?project=${this.id}`
                });
            },
        }
    }
</script>

<style>
    .options-box {
        left: 10.5rem;
        top: 1.5rem;
    }
</style>