<template xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
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
            <div  class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr class="info" >
                        <th style="width: 20px">ID</th>
                        <th>Tasca</th>
                        <th>Prioritat</th>
                        <th>Estat</th>
                        <th>Progres</th>
                        <th style="width: 40px">Label_Into</th>
                        <th>Drop</th>
                    </tr>
                    </thead>
                    <tbody v-bind:class="{'is-collapsed' : collapsed }">
                    <tr v-for="(todo, index) in filteredTodos">
                        <!--<todo></todo>-->

                        <td>{{index + from}}</td>
                        <td><div v-show="!nom[index]" @dblclick="semaforNom(index,todo)">{{todo.name}}</div>
                        <input type="text" v-model="todo.name" v-show="nom[index]" @keyup.enter="semaforNom(index,todo)"></td>
                        <td>{{todo.priority}}</td>
                        <td>{{todo.done}}</td>
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
            <div class="box-footer clearfix">
                <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }}</span>
                <div class="container">
                    <div id="app" class="well">
                    </div>
                    <pagination :current-page="page"
                                :items-per-page="perPage"
                                :total-pages="total"
                                @page-changed="pageChanged">
                    </pagination>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<style>

.is-collapsed {

	tr:nth-child(n+5) {
		display: none;
	}
}

    /* Hide un-compiled mustache bindings
    until the Vue instance is ready */

    [v-cloak] {
      display: none;
    }

    *{
        margin:0;
        padding:0;
    }

    body{
        font:12px/1.3 'Open Sans', sans-serif;
        color: #5e5b64;
        text-align:center;
    }

    a, a:visited {
        outline:none;
        color:#389dc1;
    }

    a:hover{
        text-decoration:none;
    }

    section, footer, header, aside, nav{
        display: block;
    }


    /*-------------------------
        The edit tooltip
    --------------------------*/

    .tooltip{
        background-color:#5c9bb7;

        background-image:-webkit-linear-gradient(top, #5c9bb7, #5392ad);
        background-image:-moz-linear-gradient(top, #5c9bb7, #5392ad);
        background-image:linear-gradient(top, #5c9bb7, #5392ad);

        box-shadow: 0 1px 1px #ccc;
        border-radius:3px;
        width: 290px;
        padding: 10px;

        position: absolute;
        left:50%;
        margin-left:-150px;
        top: 80px;
    }

    .tooltip:after{
        /* The tip of the tooltip */
        content:'';
        position:absolute;
        border:6px solid #5190ac;
        border-color:#5190ac transparent transparent;
        width:0;
        height:0;
        bottom:-12px;
        left:50%;
        margin-left:-6px;
    }

    .tooltip input{
        border: none;
        width: 100%;
        line-height: 34px;
        border-radius: 3px;
        box-shadow: 0 2px 6px #bbb inset;
        text-align: center;
        font-size: 16px;
        font-family: inherit;
        color: #8d9395;
        font-weight: bold;
        outline: none;
    }

    p{
        font-size:12px;
        font-weight:bold;
        color:#6d8088;
        height: 30px;
        cursor:default;
    }

    p b{
        color:#ffffff;
        display:inline-block;
        padding:5px 10px;
        background-color:#c4d7e0;
        border-radius:2px;
        text-transform:uppercase;
        font-size:18px;
    }

    p:before{
        content:'✎';
        display:inline-block;
        margin-right:5px;
        font-weight:normal;
        vertical-align: text-bottom;
    }

    #main{
        height:300px;
        position:relative;
        padding-top: 150px;
    }
    </style>

<script>
import Pagination from './Pagination.vue'
//import Pagination from './Todo.vue'
    export default {
    components : { Pagination }, //components : { Pagination, Todo },
    data(){
        return {
            collapsed: true,
            todos: [],
            visibility: 'totes',
            newTodo: '',
            nom: [],
            perPage: 5,
            from: 0,
            to: 0,
            total: 0,
            page: 1,
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
        console.log('Component Todolist creat');
        this.fetchData();
    },
    methods: {
        pageChanged: function (pageNum) {
            this.page = pageNum;
            this.fetchPage(pageNum);
            },
        semaforNom: function(index, todo) {
                this.nom[index] = !this.nom[index];
                if (!this.nom[index]) this.editaNom(index,todo);
                this.fetchPage(this.page);
            },
        editaNom: function(index,todo){
            this.filteredTodos[index].name = todo.name;
            this.actuApi(todo);
            console.log(todo);
            console.log(this.filteredTodos[index].name);
            },
         actuApi: function (todo){
            this.$http.put('/api/v1/task/' + todo.id,{
                name : todo.name,
                priority : this.todo.priority,
                done : this.todo.done,
             }).then((response) => {
                console.log(response);
            }, (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
                console.log(response);
            });
            },
        addTodo: function() {
           var value = this.newTodo && this.newTodo.trim();
           if (!value) {
               return;
                }
               var todo = {
                    name: value,
                    priority: 1,
                    done: false
                };
                this.todo.push(todo);
                this.newTodo = '';
                this.addTodoToApi(todo);
                this.fetchPage(this.page);

            },

            addTodoToApi: function(todo){

             this.$http.post('/api/v1/task', {
                name: todo.name,
                priority: todo.priority,
                done: todo.done,
                user_id: todo.user_id,
             }).then((response) => {
                console.log(response);
             },
                (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
                console.log(response);
             });
            // this.fetchPage(this.page);
            },
         deleteFromApi: function(id) {
            this.$http.delete('/api/v1/task/' + id).then((response) => {
                console.log(response);
            }, (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
                console.log(response);
            });
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
        // GET someUrl
            this.$http.get('/api/v1/task?page=' + page).then((response) => {
                console.log(response);
            this.todos = response.data.data;
            this.perPage = response.data.data.per_page;
            this.to = response.data.to;
            this.from = response.data.from;
            this.total = response.data.total;
            }, (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
               console.log(response);
             });
        }
    },

}
</script>