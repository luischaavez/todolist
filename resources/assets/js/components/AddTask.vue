<template>
	<div>
		<textarea name="task" class="task" v-model="newTask"></textarea>
		<button class="add-task" @click="add">Add</button>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				newTask: "",
			}
		},
		methods: {
			add() {
				this.$emit('created', { task: this.newTask, completed: false});

				this.newTask = "";
			}
		}
	}
</script>
