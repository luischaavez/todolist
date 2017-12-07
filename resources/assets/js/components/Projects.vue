<template>
    <div>
        <ul v-for="project in projects" class="projects-list">
            <li>{{ project.name }}</li>
        </ul>

        <new-project @created="store"></new-project>
    </div>
</template>

<script>
    import axios from 'axios';
    import NewProject from './NewProject.vue';

    export default {

        components: { NewProject },

        data() {
            return {
                projects: []
            }
        },
        methods: {
            store(data) {
                axios.post('/projects', data).then((response) => {
                    this.projects.push(data);
                })
            }
        }
    }
</script>