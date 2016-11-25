<template>
    <div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tasques</h3>
            </div>
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
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(todo, index) in filteredTodos">
                        <td class="active">{{index + 1}}</td>
                        <td class="warning">{{todo.name}}</td>
                        <td class="danger">{{todo.priority}}</td>
                        <td class="success">{{todo.done}}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 85%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-blue">85%</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style>

</style>

<script>
    export default {
    data(){
        return {
            message: 'Hola que ase',
            seen: false,
            visibility: 'all',
            todos: [],
             //'active' 'completed'
        }
    },
    computed: {
        filteredTodos: function() {

        var filters = {
            all: function(todos){
                return todos;
            },
            active: function(todos){
            return todos.filter(function(todo){
                return !todo.done;
            });

            },
            completed: function(todos){
            return todos.filter(function(todo){
            return todo.done;
            });

            }
        }

        return filters[this.visibility](this.todos);

        }
    },
    created() {
        console.log('Component Todolist creat');
        this.fetchData();
    },
    methods: {
        reverseMessage:function () {
        this.message = this.message.split('').reverse().join('');
        },
        fetchData:function (){

         // GET /someUrl
            this.$http.get('/api/v1/task').then((response) => {
            this.todos = response.data.data;
            }, (response) => {
        // error callback
            sweetAlert("Oops...", "Something went wrong!", "error");
            console.log(response);
             });

        }
    }
}
</script>