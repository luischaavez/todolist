<template>
    <div>
        <div v-if="creating" class="new-project-container p-2">
            <input v-model="name" type="text" name="name" class="new-project w-full p-2 border rounded text-grey-darker">

            <div class="mt-2">
                <button @click="add"
                        class="text-teal-dark text-sm font-bold bg-white border rounded border-teal-dark py-1 px-2 hover:bg-teal-dark hover:text-white add-project">
                    Add Project
                </button>
                <button @click="creating = false"
                        class="text-red-light text-sm font-bold py-1 px-2 bg-white border rounded border-red hover:bg-red-light hover:text-white">
                    Cancel
                </button>
            </div>
        </div>

        <div v-else>
            <a  @click="display"
                class="text-teal text-sm show-container cursor-pointer hover:underline">
                <span class="fa fa-plus"></span>
                Add Project
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                creating: false,
                name: ''
            }
        },
        methods: {
            display() {
                this.creating = true;
            },

            add() {
               this.$emit('created', { name: this.name });

               this.name = '';
            }
        }
    }
</script>