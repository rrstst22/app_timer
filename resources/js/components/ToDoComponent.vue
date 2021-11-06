<template>
    <div>
        <div class="border" v-for="(todo, index) in todos" v-bind:key="index">
            <button class="btn holiday p-4" v-on:click="update(index)">{{ todo.date }} {{ todo.name }}</button>
        </div>
        <form v-on:submit.prevent>
            <!-- <input type="text" name="year">
            <input type="text" name="month">
            <input type="text" name="day"> -->
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
                selected_time: "2021-11-07",
                date: "",
                name: ""
            }
        },
        mounted() { //createdにすると動かない
            this.getTodos();
        },
        methods: {
            update: function(index) {
                this.selected_time = index;
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
                        // self.todos = response.data;
                    }).catch(function(error){
                        alert(error);
                });               
            }
        }
    }

</script>

<style scoped>
.time-box {
    font-size: 1.5rem;
    
}
.holiday-box {
    overflow-y: scroll;
    height: 500px;
    cursor: pointer;
}
.holiday {
    width: 100%;
}
</style>