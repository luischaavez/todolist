<template>
    <div>
        <ul v-if="projects.length" class="projects-list list-reset mb-3">
            <li v-for="(project, index) in projects" :key="project.id" class="pl-3 mb-3">
              <project :attributes="project" @deleted="remove(index)"></project>
            </li>
        </ul>

        <new-project @created="store"></new-project>
    </div>
</template>

<script>
    import axios from 'axios';
    import NewProject from './NewProject.vue';
    import Project from './Project.vue';

    export default {

        components: { Project, NewProject },

        data() {
            return {
                projects: [],
            }
        },

        created() {
            axios.get('/projects').then(this.refresh);
        },

        methods: {
            refresh({data}) {
                this.projects = data;
            },

            store(data) {
                axios.post('/projects', data).then((response) => {
                    this.projects.push(response.data);
                })
            },

            remove(index) {
                this.projects.splice(index, 1);
            }
        }
    }
</script>