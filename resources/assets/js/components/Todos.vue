<template>
    <div id="app">
        <p v-show="seen">{{message}}</p>
        <input type="text" v-model="message">
        <button v-on:click="reverseMessage">Reverse</button>

        <ol>
            <li v-for="todo in todos">{{ todo.name }} | {{ todo.priority }} | {{ todo.done }}</li>
        </ol>
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