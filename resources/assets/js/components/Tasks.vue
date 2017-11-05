<template>
	<div>
		<ul v-if="tasks.length" v-for="task in tasks">
			<li>{{ task.task }}</li>
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

		created(){
			axios.get(`${location.pathname}`).then(this.refresh);
		},

		methods: {
			refresh({data}) {
                this.tasks = data;
            
                window.scrollTo(0, 0);
            },
			push(task) {
				return this.tasks.push(task);
			}
		}
	}
</script>
