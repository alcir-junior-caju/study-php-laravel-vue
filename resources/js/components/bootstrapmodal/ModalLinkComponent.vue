<template>
    <!-- Button trigger modal -->
    <span>
        <span v-if="item">
            <button @click="fillForm()" v-if="!type || (type != 'button' && type != 'a')" type="button" :class="css || 'btn btn-primary mb-2'" data-toggle="modal" :data-target="'#' + id">
                {{ title }}
            </button>
            <button @click="fillForm()" v-if="type == 'button'" type="button" :class="css || 'btn btn-primary mb-2'" data-toggle="modal" :data-target="'#' + id">
                {{ title }}
            </button>
            <a @click="fillForm()" v-if="type == 'a'" href="#" :class="css || 'mb-2'" data-toggle="modal" :data-target="'#' + id">{{ title }}</a>
        </span>
        <span v-if="!item">
            <button v-if="!type || (type != 'button' && type != 'a')" type="button" :class="css || 'btn btn-primary mb-2'" data-toggle="modal" :data-target="'#' + id">
                {{ title }}
            </button>
            <button v-if="type == 'button'" type="button" :class="css || 'btn btn-primary mb-2'" data-toggle="modal" :data-target="'#' + id">
                {{ title }}
            </button>
            <a v-if="type == 'a'" href="#" :class="css || 'mb-2'" data-toggle="modal" :data-target="'#' + id">{{ title }}</a>
        </span>
    </span>
</template>
<script>
    export default {
        props: ['type', 'id', 'title', 'css', 'item', 'url'],
        methods: {
            fillForm: function () {
                axios.get(this.url + this.item.id).then(res => {
                    this.$store.commit('setItem', res.data);
                });
                // this.$store.commit('setItem', this.item);
            }
        }
    }
</script>
