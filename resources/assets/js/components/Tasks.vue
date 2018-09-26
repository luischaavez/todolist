<template>
	<div>
		<div class="text-black font-bold text-2xl my-4 text-left ml-4">{{ title }}</div>

		<ul v-if="tasks.length" class="list-reset tasks-list">
			<li v-for="(task, index) in tasks" :key="task.id" 
				
			>
				<task :attributes="task" @completed="remove(index)" @deleted="remove(index)"></task>	
			</li>
		</ul>

		<div class="w-full">
			<new-task :project="project" @created="push"></new-task>
		</div>
	</div>
</template>

<script>
	import axios from 'axios';
	import NewTask from './NewTask.vue';
	import Task from './Task.vue';

	export default {
		components: { NewTask, Task },

		data() {
			return {
			    title: 'Dashboard',
				tasks: [],
				project: null,
			}
		},

		created(){
			axios.get('/tasks').then(this.refresh);

			window.events.$on('filter', data => this.applyFilter(data));
		},

		methods: {
			refresh({data}) {
                this.tasks = data;
            },

			push(task) {
			    /* if(this.project) {
			        task.project = this.project;
				}

				axios.post('/tasks/create', task)
					.then(({data}) => {
						this.tasks.push(data);
					});*/
				this.tasks.push(data);
 			},

            applyFilter(data) {
				let vm = this;
				
                axios.get(data.url).then(response => {
                    vm.title = data.title;
					vm.tasks = response.data;
					vm.project = data.project ? data.project : null;
                });
            },

			remove(index) {
				this.tasks.splice(index, 1);
			}
		}
	}
</script>
