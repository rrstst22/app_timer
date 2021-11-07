<template>
    <div>
        <div class="todo-box">
            <div class="border" v-for="(todo, index) in todos" v-bind:key="index">
                <button class="btn holiday p-4" v-on:click="update(todo.id)">{{ formatDate(todo.date) }} {{ todo.name }}</button>
                <button v-on:click="deleteTodo(todo.id)">削除</button>
            </div>
        </div>
        <form v-on:submit.prevent>
            <input type="date" name="date" v-model="date">
            <input type="text" name="name" v-model="name">
            <button type="submit" v-on:click="registerTodo">登録</button>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                todos: [],
                selected_time: 0,
                date: "",
                name: ""
            }
        },
        mounted() { //createdにすると動かない
            this.getTodos();
        },
        methods: {
            update: function(selected_time) {
                this.$emit('todo-click', selected_time);
            },
            deleteTodo: function(todo_id) {
                var self = this;
                axios.delete('vue/delete-todo', {
                    data: {id: todo_id}
                })
                    .then(function(response){
                        self.getTodos();
                    }).catch(function(error){
                        alert(error);
                });          
            },
            getTodos: function() {
                var self = this;
                axios.get('get-todos')
                    .then(function(response){
                        self.todos = response.data;
                    }).catch(function(error){
                        alert(error);
                });
            },
            registerTodo: function() {
                var self = this;
                axios.post('vue/register-todo', {
                    date: this.date,
                    name: this.name
                })
                    .then(function(response){
                        self.date = "",
                        self.name = ""
                        self.getTodos();
                        // self.todos = response.data;
                    }).catch(function(error){
                        alert(error);
                });               
            },
            formatDate: function(todo_date){
                const time = Date.parse(todo_date);
                const date = new Date(time);
                const year = date.getFullYear();
                const month = ("0"+(date.getMonth() + 1)).slice(-2);
                const day = ("0"+date.getDate()).slice(-2);
                const formatted_date = year + "-" + month + "-" + day; 

                return formatted_date;
            },
        }
    }

</script>

<style scoped>
.time-box {
    font-size: 1.5rem;
    
}
.todo-box {
    overflow-y: scroll;
    height: 500px;
    /* cursor: pointer; */
}
.holiday {
    width: 80%;
}
</style>