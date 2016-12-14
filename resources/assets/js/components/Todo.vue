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
                        <todo></todo>

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

</style>
<template>
    <div>
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

    </div>
</template>
<script>
import Pagination from './Pagination.vue'
    export default {
    components : { Pagination },
    data(){
        return {
            editing: false
            }
    },

    created() {
        console.log('Component Todolist creat');

    },
    methods: {
        hello: fucntion(){
        console.log('Hello todo');
        }
    },

}
</script>