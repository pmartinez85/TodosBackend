<template xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tasques</h3>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-default">{{visibility}}</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                   <span class="caret"> </span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#"  v-on:click="setVisibility('totes')">Totes</a></li>
                    <li><a href="#"  @click="setVisibility('actives')">Actives</a></li>
                    <li><a href="#/" @click="setVisibility('completades')">Completades</a></li>
                </ul>
            </div>
            <form role="form" action="#">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Escriu la tasca a crear"
                        v-model="newTodo"
                        @keyup.enter="addTodo">
                    </div>
                </div>
            </form>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr class="info">
                        <th style="width: 20px">ID</th>
                        <th>Tasca</th>
                        <th>Prioritat</th>
                        <th>Estat</th>
                        <th>Progres</th>
                        <th style="width: 40px">Label_Into</th>
                        <th>Drop</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(todo, index) in filteredTodos">
                        <td class="active">{{index + from}}</td>
                        <td class="warning">{{todo.name}}</td>
                        <td class="danger">{{todo.priority}}</td>
                        <td class="success">{{todo.done}}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 85%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-blue">85%</span></td>
                        <td><button @click="dropTodo(index)">}:)</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <!--<span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries </span>-->
                <div class="container">
                    <div id="app" class="well">
                        <h1>This is page {{pageOne.currentPage}}</h1>
                    </div>
                    <pagination :current-page="pageOne.currentPage"
                                :total-pages="pageOne.totalPages"
                                @page-changed="pageOneChanged">
                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    body {
    font-family: Helvetica, sans-serif;
    padding-top: 80px;
}

</style>

<script>

import Pagination from './Pagination.vue'
    export default {
    components : { Pagination },
    data(){
        return {
            pageOne: {
                currentPage: 1,
                totalPages: 10
            },
            todos: [],
            visibility: 'totes',
            newTodo: '',
            perPage: 5,
            from: 0,
            to: 0,
            total: 0
        }
    },
    computed: {
        filteredTodos: function() {

        var filters = {
            totes: function(todos){
                return todos;
            },
            actives: function(todos){
            return todos.filter(function(todo){
                return !todo.done;
            });

            },
            completades: function(todos){
            return todos.filter(function(todo){
                return todo.done;
            });
           },
        }

        return filters[this.visibility](this.todos);

        }
    },
    created() {
        //console.log('Component Todolist creat');
        this.fetchData();
    },
    methods: {
        pageOneChanged (pageNum) {
            this.pageOne.currentPage = pageNum
            },
        addTodo: function() {
           var value = this.newTodo && this.newTodo.trim();
           if (!value) {
               return;
                }
                this.todos.push({
                    name: value,
                    priority: 1,
                    done: false
                });
                this.newTodo = '';
            },
        dropTodo: function(index) {
                this.index = index;
                 this.todos.splice(index, 1);
            },
        setVisibility: function(visibility) {
                this.visibility = visibility;
            },
        reverseMessage:function () {
                this.message = this.message.split('').reverse().join('');
            },
        fetchData:function (){
            return this.fetchPage(1);
            },
        fetchPage:function(page){
        // GET /someUrl
            this.$http.get('/api/v1/task?page=' + page).then((response) => {
                //console.log(response);
            this.todos = response.data.data;
            this.perPage = response.data.data.per_page;
            this.to = response.data.to;
            this.from = response.data.from;
            this.total = response.data.data;

            }, (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
               // console.log(response);
             });

        }
    }
}
</script>