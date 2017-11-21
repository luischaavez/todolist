<template>
	<div>
		<div class="text-black font-bold text-2xl my-4 text-left ml-4">Dashboard</div>

		<ul v-for="task in tasks" :key="task.id" class="list-reset">
			<li class="ml-6 p-2 text-base">{{ task.task }}</li>
		</ul>

		<div class="w-full">
			<add-task @created="push"></add-task>
		</div>
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
