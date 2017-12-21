<template>
    <div class="flex items-center bg-green text-white text-sm font-bold p-4 flash-alert"
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

        methods: {
            flash(data) {
                if(data) {
                    this.body = data.message;
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