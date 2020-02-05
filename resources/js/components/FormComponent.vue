<template>
    <form :class="css || ''" :action="action" :method="definedMethod" :enctype="enctype">
        <input v-if="changeMethod" type="hidden" name="_method" :value="changeMethod">
        <input v-if="token" type="hidden" name="_token" :value="token">
        <slot></slot>
    </form>
</template>
<script>
    export default {
        props: ['css', 'action', 'method', 'enctype', 'token'],
        data: function () {
            return {
                changeMethod: ''
            }
        },
        computed: {
            definedMethod: function () {
                if (this.method.toLowerCase() == 'post' || this.method.toLowerCase() == 'get') {
                    return this.method.toLowerCase();
                }

                if (this.method.toLowerCase() == 'put') {
                    this.changeMethod = 'put';
                }

                if (this.method.toLowerCase() == 'delete') {
                    this.changeMethod = 'delete';
                }
                return 'post';
            }
        }
    }
</script>
