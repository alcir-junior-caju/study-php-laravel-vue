<template>
    <div :class="defineColor">
        <div class="card-header">{{ title }}</div>

        <div class="card-body bg-white text-dark">
            <slot></slot>
        </div>

        <div v-if="link" class="card-footer text-center">
            <a :href="link" class="text-white">{{ label }}</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'color', 'link', 'label'],
        computed: {
            defineColor: function () {
                return 'card ' + this.color;
            }
        }
    }
</script>
