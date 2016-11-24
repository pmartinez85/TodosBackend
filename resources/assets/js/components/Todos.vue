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
                    <tr v-for="(todo, index) in todos">
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
            todos: [
            ],
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

<!--data: {-->
<!--message: 'Jelou Vue!',-->
<!--seen: false,-->
<!--todos: [-->
<!--{ name: 'Learn Javascript',-->
<!--done: true,-->
<!--priority: 4-->
<!--},-->
<!--{ name: 'Learn PHP',-->
<!--done: false,-->
<!--priority: 5-->
<!--},-->
<!--{ name: 'Buy bread',-->
<!--done: false,-->
<!--priority: 1-->
<!--}-->
<!--]-->
<!--},-->
<!--methods: {-->
<!--reverseMessage:function () {-->
<!--this.message = this.message.split('').reverse().join('');-->

<!--},-->
<!--fetchData:function () {-->
<!--const app = new Vue({-->
<!--el: '#app',-->
<!--data: {-->
<!--todos: []-->
<!--},-->
<!--methods: {-->
<!--fetchData: function() {-->
<!--// GET /someUrl-->
<!--this.$http.get('/api/v1/tasks').then((response) => {-->
<!--this.todos = response.data.data;-->
<!--}, (response) => {-->
<!--// error callback-->
<!--sweetAlert("Oops...", "Something went wrong!", "error");-->
<!--console.log(response);-->
<!--});-->
<!--}-->
<!--},-->

<!--});-->
<!--}-->
<!--},-->
<!--created: function(){-->
<!--console.log('App created');-->
<!--this.fetchData()-->
<!--}-->