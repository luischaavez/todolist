<template>
	<div>
		<ul v-for="task in tasks">
			<li>{{ task.body }}</li>
		</ul>
		<textarea name="task" class="task" v-model="newTask"></textarea>
		<button class="add-task" @click="add">Add</button>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				newTask: "",
				tasks: [],
			}
		},
		methods: {
			add() {
				this.tasks.push({ body: this.newTask, completed: false});
			}
		}
	}
</script>
