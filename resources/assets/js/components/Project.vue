<template>
     <div class="p-1 cursor-pointer relative" @mouseover="showOptions = true" @mouseleave="showOptions = false">
        <span class="fas fa-bullseye text-sm"></span>
        {{ attributes.name }}
        <span class="text-xs float-right pr-1 pt-3px" :class="[showOptions ? 'inline' : 'hidden']" @click="optionsBox = true">
            <i class="fas fa-ellipsis-v text-grey-dark hover:text-grey-darkest"></i>
        </span>

         <div v-if="optionsBox" class="z-30 absolute shadow-md options-box bg-white w-24 text-sm border rounded" v-on-clickaway="away">
             <div class="px-2 py-1 text-center hover:bg-grey-lighter rounded-t">Edit</div>
             <div @click="remove" class="px-2 py-1 text-center hover:bg-grey-lighter rounded-b">Remove</div>
         </div>
    </div>
</template>

<script>
    import { mixin as clickaway } from 'vue-clickaway';

    export default {
        props: ['attributes'],
        mixins: [clickaway],
        data() {
            return {
                showOptions: false,
                optionsBox: false
            }
        },
        methods: {
            remove() {
                let vm = this;

                axios.delete('/projects/' + this.attributes.id)
                    .then(() => { vm.$emit('deleted') });
            },
            away() {
                this.optionsBox = false;
            }
        }
    }
</script>

<style>
    .options-box {
        left: 10.5rem;
        top: 1.5rem;
    }
</style>