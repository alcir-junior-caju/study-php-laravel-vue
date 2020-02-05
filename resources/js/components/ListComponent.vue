<template>
    <div class="table-responsive">
        <a class="btn btn-success mb-3" v-if="create && !modal" :href="create">Novo</a>
        <modalink v-if="create && modal" type="button" id="createData" title="Inserir" css=""></modalink>
        <div class="form-inline float-right">
            <input type="search" class="form-control" placeholder="Buscar" v-model="search">
        </div>
        <table class="table table-striped table-hover m-0">
            <thead>
                <tr>
                    <th scope="col" @click="orderColumn(index)" v-for="(title, index) in titles" :key="title" style="cursor:pointer;">{{ title }}</th>
                    <th v-if="show || edit || remove" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, index) in list" :key="row.id">
                    <td v-for="data in row" :key="data">{{ data }}</td>
                    <td v-if="show || edit || remove">
                        <form v-if="remove && token" :id="index" :action="remove + row.id" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="token">

                            <a v-if="show && !modal" :href="show">Ver |</a>
                            <modalink v-if="show && modal" :item="row" :url="show" type="a" id="showData" title="Ver |" css=""></modalink>
                            <a v-if="edit && !modal" :href="edit">Editar |</a>
                            <modalink v-if="edit && modal" :item="row" :url="edit" type="a" id="editData" title="Editar |" css=""></modalink>
                            <a href="#" @click="deleteData(index)">Deletar</a>
                        </form>
                        <span v-if="!token">
                            <a v-if="show && !modal" :href="show">Ver |</a>
                            <modalink v-if="show && modal" :item="row" :url="show" type="a" id="showData" title="Ver |" css=""></modalink>
                            <a v-if="edit && !modal" :href="edit">Editar |</a>
                            <modalink v-if="edit && modal" :item="row" :url="edit" type="a" id="editData" title="Editar |" css=""></modalink>
                            <a v-if="remove" :href="remove">Deletar</a>
                        </span>
                        <span v-if="token && !remove">
                            <a v-if="show && !modal" :href="show">Ver |</a>
                            <modalink v-if="show && modal" :item="row" :url="show" type="a" id="showData" title="Ver |" css=""></modalink>
                            <a v-if="edit && !modal" :href="edit">Editar</a>
                            <modalink v-if="edit && modal" :item="row" :url="edit" type="a" id="editData" title="Editar |" css=""></modalink>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['titles', 'itens', 'order', 'column', 'create', 'show', 'edit', 'remove', 'token', 'modal'],
        data: function () {
            return {
                search: '',
                orderaux: this.order || 'asc',
                columnaux: this.column || 0
            }
        },
        computed: {
            list: function () {
                let list = this.itens.data;
                let order = this.orderaux;
                let column = this.columnaux;

                order = order.toLowerCase();
                column = parseInt(column);

                if (order == 'asc') {
                    list.sort(function (a, b) {
                        if (Object.values(a)[column] > Object.values(b)[column]) { return 1; }
                        if (Object.values(a)[column] < Object.values(b)[column]) { return -1; }
                        return 0;
                    });
                } else {
                    list.sort(function (a, b) {
                        if (Object.values(a)[column] < Object.values(b)[column]) { return 1; }
                        if (Object.values(a)[column] > Object.values(b)[column]) { return -1; }
                        return 0;
                    });
                }

                if (this.search) {
                    return list.filter(res => {
                        res = Object.values(res);
                        for(let k = 0; k < res.length; k++) {
                            if ((res[k] + '').toLowerCase().indexOf(this.search.toLowerCase()) >= 0) {
                                return true;
                            }
                        }
                        return false;
                    });
                }

                return list;
            }
        },
        methods: {
            deleteData: function (index) {
                document.getElementById(index).submit();
            },
            orderColumn: function (column) {
                this.columnaux = column;
                if (this.orderaux.toLowerCase() == 'asc') {
                    this.orderaux = 'desc';
                } else {
                    this.orderaux = 'asc';
                }
            }
        }
    }
</script>
