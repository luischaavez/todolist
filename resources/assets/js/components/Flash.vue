<template>
    <div :class="color" class="flex items-center text-white text-sm font-bold p-4 flash-alert"
         role="alert"
         v-show="show"
         v-text="body"
    >
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: this.message,
                level: 'success',
                show: false
            }
        },

        created() {
            if(this.message) {
                this.flash();
            }

            window.events.$on(
              'flash', data => this.flash(data)
            );
        },

        computed: {
            color() {
                let colors = {
                    'success': 'bg-green',
                    'error': 'bg-red',
                    'warning': 'bg-yellow-dark'
                };

                return colors[this.level];
            }
        },

        methods: {
            flash(data) {
                if(data) {
                    this.body = data.message;
                    this.level = data.level
                }

                this.show = true;

                this.hide();
            },
            
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style>
    .flash-alert {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>