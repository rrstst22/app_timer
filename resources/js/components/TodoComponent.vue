<template>
    <div class="p-4">
        <div class="text-center"><h3>ToDoリスト</h3></div>
        <div class="todo-section">
            <div class="border todo-box" v-for="(todo, index) in todos" v-bind:key="index">
                <button class="btn todo-btn py-3" v-on:click="update(todo.id)">
                    {{ formatDate(todo.date) }}<br>
                    {{ todo.name }}
                </button>
                <button class="btn delete-btn btn-outline-primary" v-on:click="deleteTodo(todo.id)">削除</button>
            </div>
        </div>
        <form class="py-4" v-on:submit.prevent>
            <input class="form-control rounded" type="date" name="date" v-model="date">
            <div class="input-group m-auto">
                <input class="form-control rounded" type="text" name="name" v-model="name" maxlength="10" placeholder="イベント名">
                <button class="btn btn-outline-primary" type="submit" v-on:click="registerTodo">登録</button>
            </div>
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
                name: null
            }
        },
        mounted() {
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
                if(this.name){
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
                }else{
                    alert("イベント名を入力してください。")
                }             
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
.todo-section {
    overflow-y: scroll;
    height: 400px;
}
.todo-box {
    display: flex;
    flex-wrap: nowrap;
}
.todo-btn {
    flex-grow: 2;
    border-radius: 9px;
}
</style>