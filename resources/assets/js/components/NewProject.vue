<template>
    <div>
        <div v-if="creating" class="new-project-container p-2">
            <input v-model="name" type="text" name="name" class="new-project w-full p-2 border rounded text-grey-darker">

            <div class="mt-2 pr-2">
                <button @click="add"
                        class="text-teal-dark text-xs font-bold bg-white border rounded border-teal-dark p-1 hover:bg-teal-dark hover:text-white add-project">
                    Add Project
                </button>
                <button @click="creating = false"
                        class="text-red-light text-xs font-bold p-1 bg-white border rounded border-red hover:bg-red-light hover:text-white">
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

               flash('Project created successfully!')

               this.name = '';
            }
        }
    }
</script>