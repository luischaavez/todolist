<template>
	<div v-if="adding" class="mx-3 flex flex-col add-container">
		<div class="w-full">
			<textarea ref="task" name="task" v-model="newTask" @keydown.enter.prevent="add"
					  class="shadow appearance-none border rounded w-full py-1 px-3 text-grey-darker text-sm task resize-none mr-2" rows="3"  autofocus></textarea>
		</div>

		<div class=" ml-2 mt-2 max-w-sm">
			<button class="text-teal-dark text-sm font-bold bg-white border rounded border-teal-dark py-1 px-4 hover:bg-teal-dark hover:text-white add-task" @click="add">
				Add
			</button>
			<button class="text-red-light text-sm font-bold py-1 px-4 bg-white border rounded border-red hover:bg-red-light hover:text-white" @click="adding = false">
				Cancel
			</button>
		</div>
	</div>

	<div v-else  class="text-left pl-3 cursor-pointer">
		<a @click="display" class="text-teal text-sm show-container cursor-pointer hover:underline"><span class="fa fa-plus"></span> Add Task</a>
	</div>
</template>

<script>
	export default {
		data() {
			return {
			    adding: false,
				newTask: "",
			}
		},
		methods: {
			add() {
				this.$emit('created', { task: this.newTask, completed: false});

				this.newTask = "";

				this.setFocus()
			},

			display() {
			    this.adding = true;

			    this.$nextTick().then(this.setFocus);
			},

            setFocus() {
                this.$refs.task.focus();
            },
		}
	}
</script>
