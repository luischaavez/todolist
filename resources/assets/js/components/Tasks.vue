<template>
	<div>
		<ul v-for="task in tasks" :key="task.id">
			<li>{{ task.task }}</li>
		</ul>

		<add-task @created="push"></add-task>
	</div>
</template>

<script>
	import axios from 'axios';
	import AddTask from './AddTask.vue';

	export default {
		components: { AddTask },

		data() {
			return {
				tasks: []
			}
		},

		created(){
			axios.get('/tasks').then(this.refresh);
		},

		methods: {
			refresh({data}) {
                this.tasks = data;
            },
			push(task) {
				axios.post('/tasks/create', task)
					.then(({data}) => {
						this.tasks.push(data);
					});
			}
		}
	}
</script>
