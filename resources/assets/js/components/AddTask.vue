<template>
	<div v-if="show" class="mx-3 flex items-center add-container">
		<textarea name="task" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker task resize-none max-w-sm mr-2" v-model="newTask"></textarea>
		<button class="text-teal-dark font-bold bg-white border rounded border-teal-dark p-2 hover:bg-teal-dark hover:text-white add-task" @click="add">Add</button>
	</div>

	<div v-else  class="text-left pl-3 cursor-pointer">
		<a @click="display" class="text-teal text-sm show-container cursor-pointer hover:underline"><span class="fa fa-plus"></span> Add Task</a>
	</div>
</template>

<script>
	export default {
		data() {
			return {
			    show: false,
				newTask: "",
			}
		},
		methods: {
			add() {
				this.$emit('created', { task: this.newTask, completed: false});

				this.newTask = "";
			},

			display() {
			    this.show = true;
			}
		}
	}
</script>
