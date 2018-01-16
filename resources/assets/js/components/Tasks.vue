<template>
	<div>
		<div class="text-black font-bold text-2xl my-4 text-left ml-4">{{ title }}</div>

		<ul v-if="tasks.length" class="list-reset tasks-list">
			<li v-for="(task, index) in tasks" :key="task.id" 
				class="ml-4 py-3 text-base border-b border-grey-light mb-4"
			>
				<div class="flex w-full">
					<input type="checkbox" class="complete" @click="complete(task, index)">
					<p class="text-sm pl-2">{{ task.task }}</p>
				</div>
			</li>
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
			    if(this.project) {
			        task.project = this.project;
				}

				axios.post('/tasks/create', task)
					.then(({data}) => {
						this.tasks.push(data);
					});
			},

			complete(task, index) {
			    axios.patch('/tasks/' + task.id + '/complete').then(() =>{
			        this.tasks.splice(index, 1);
				});
			},

            applyFilter(data) {
			    console.log(data);
                let vm = this;
                axios.get(data.url).then(response => {
                    vm.title = data.title;
					vm.tasks = response.data;
					vm.project = data.project ? data.project : null;
                });
            }
		}
	}
</script>
