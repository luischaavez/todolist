<template>
	<div>
		<ul v-if="tasks.length" v-for="task in tasks">
			<li>{{ task.body }}</li>
		</ul>

		<add-task @created="push"></add-task>
	</div>
</template>

<script>
	import AddTask from './AddTask.vue'
	export default {
		components: { AddTask },
		data() {
			return {
				tasks: []
			}
		},
		methods: {
			push(task) {
				return this.tasks.push(task);
			}
		}
	}
</script>
