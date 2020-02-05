<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li :class="definedClass" v-for="item in list" :key="item.id">
                <a v-if="item.url" :href="item.url">
                    {{ item.title }}
                </a>
                <span v-if="!item.url">{{ item.title }}</span>
            </li>
        </ol>
    </nav>
</template>
<script>
    export default {
        props: ['list'],
        computed: {
            definedClass: function () {
                if (this.url) {
                    return 'breadcrumb-item active';
                } else {
                    return 'breadcrumb-item';
                }
            }
        }
    }
</script>
