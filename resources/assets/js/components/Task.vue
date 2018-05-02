<template>
    <on-click-outside :do="hideOptionsBox">
        <div class="flex relative w-full ml-4 py-3 text-base border-b border-grey-light mb-4 cursor-pointer"
            @mouseover="options = true"
            @mouseleave="options = false"
        >
            <div class="w-1/2">
                <input :id="'task-' + this.id" 
                    type="checkbox" 
                    class="complete cursor-pointer" 
                    @click="complete"
                >
                
                <label :for="'task-' + this.id" class="text-sm pl-2 cursor-pointer">
                    {{ attributes.body }}
                </label>
            </div>

            <div class="w-1/2">
                <span class="cursor-pointer text-xs float-right pr-8 pt-3px" :class="[options ? 'inline' : 'hidden']" @click="optionsBox = true">
                    <i class="fas fa-ellipsis-v text-grey-dark hover:text-grey-darkest"></i>
                </span>
            </div>

            <div v-if="optionsBox" class="z-30 absolute shadow-md task-options-box bg-white w-24 text-sm border rounded">
                <div class="px-2 py-1 text-center hover:bg-grey-lighter rounded-t">Edit</div>
                <div @click="destroy" class="px-2 py-1 text-center hover:bg-grey-lighter rounded-b">Remove</div>
            </div>
        </div>
    </on-click-outside>
</template>

<script>
import OnClickOutside from './OnClickOutside.vue';

export default {
    props: ["attributes"],
    components: { OnClickOutside },
    data() {
        return {
            id: this.attributes.id,
            options: false,
            optionsBox: false
        }
    },
    methods: {
        complete() {
            axios.patch('/tasks/' + this.id + '/complete');

            this.$emit('completed', this.id);
        },

        destroy() {
            axios.delete('/tasks/' + this.id);

            flash('Task deleted successfully!');

            this.$emit('deleted', this.id);
        },

        hideOptionsBox() {
            this.optionsBox = false;
        }
    }
}
</script>

<style>
    .task-options-box {
        right: 0;
        top: 1.5rem;
    }
</style>