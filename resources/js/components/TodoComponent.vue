<template>
    <div>
        <div class="text-center"><h3><i class="fas fa-sticky-note m-1"></i>ToDoリスト</h3></div>
        <div class="todo-section">

            <!-- v-forでTodo一覧を表示 -->
            <div class="border" v-for="(todo, index) in todos" v-bind:key="index">

                <!-- 今日の日付を基準にしてTodoのボックスの色を変える -->
                <!-- Todoが今日より後の場合 -->
                <div v-if="compareDate(todo.date)" class="todo-box">
                    <button class="btn todo-btn py-3" v-on:click="update(todo.id)">
                        {{ formatDate(todo.date) }}<br>
                        {{ todo.name }}
                    </button>
                    <button class="btn delete-btn btn-outline-primary" v-on:click="deleteTodo(todo.id)">削除</button>
                </div>

                <!-- Todoが今日より前の場合 -->
                <div v-else class="todo-box">
                    <button class="btn todo-btn-passed py-3" v-on:click="update(todo.id)">
                        {{ formatDate(todo.date) }}<br>
                        {{ todo.name }}
                    </button>
                    <button class="btn delete-btn-passed btn-outline-primary" v-on:click="deleteTodo(todo.id)">削除</button>
                </div>

            </div>

        </div>

        <!-- イベントの登録フォーム -->
        <form class="event-form" v-on:submit.prevent>
            <input class="form-control rounded" type="date" name="date" v-model="date" v-bind:class={red:error_date}>
            <div class="input-group m-auto">
                <input class="form-control rounded" type="text" name="name" v-model="event_name" v-bind:class={red:error_event} maxlength="10" placeholder="イベント名">
                <button type="submit" class="btn btn-outline-primary" v-on:click="registerTodo">登録</button>
            </div>
            <small class="px-2 form-text text-muted">※最大10文字</small>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                todos: [],
                selected_todo: 0,
                date: "",
                event_name: null,
                error_date: false,
                error_event: false,
            }
        },
        mounted() {
            this.getTodos();
        },
        methods: {
            //選択したTodoを親コンポーネントへ送信
            update: function(selected_todo) {
                this.$emit('todo-click', selected_todo);
                this.closeModal();
            },
            //モーダルウィンドウをクローズ
            closeModal: function() {
                this.$emit('todo-click-c');
            },
            //Todoリストを削除
            deleteTodo: function(todo_id) {
                var self = this;
                axios.delete('vue/delete-todo', {
                    data: {id: todo_id}
                })
                    .then(function(response) {
                        self.getTodos();
                    }).catch(function(error) {
                        alert(error);
                });          
            },
            //Todoリストを取得
            getTodos: function() {
                var self = this;
                axios.get('vue/get-todos')
                    .then(function(response) {
                        self.todos = response.data;
                    }).catch(function(error) {
                        alert(error);
                });
            },
            //Todoを登録
            registerTodo: function() {
                this.error_date = false;
                this.error_event = false;
                //Null処理
                if(this.date && this.event_name) {
                    var self = this;
                    axios.post('vue/register-todo', {
                        date: this.date,
                        name: this.event_name
                    })
                        .then(function(response) {
                            self.date = "";
                            self.event_name = "";
                            self.getTodos(); //Todoリスト更新
                            self.error = response.data;
                        }).catch(function(error){
                            alert(error);
                    });  
                }else {
                    if(!this.date) {
                        this.error_date = true;
                    }
                    if(!this.event_name) {
                        this.error_event = true;
                    }
                }             
            },
            //日付の表示形式を指定
            formatDate: function(todo_date) {
                //文字列をdatetime型へ変換
                const time = Date.parse(todo_date);
                const date = new Date(time);

                //年月日を取得し、フォーマットを作成
                const year = date.getFullYear();
                const month = ("0"+(date.getMonth() + 1)).slice(-2);
                const day = ("0"+date.getDate()).slice(-2);
                const formatted_date = year + "-" + month + "-" + day; 

                return formatted_date;
            },
            //今日の日付とイベントの日付を比較
            compareDate: function(todo_date) {
                const time = Date.parse(todo_date); //文字列をdatetime型へ変換
                const now = new Date(); //今日の日付を取得

                if(now <= time) {
                    return true;
                }else {
                    return false;
                }
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
    flex-grow: 1;
    border-radius: 9px;
}
.todo-btn-passed {
    flex-grow: 1;
    border-radius: 9px;
    opacity: .4;
}
.delete-btn-passed {
    opacity: .4;
}
.event-form {
    padding-top: 30px; 
}
.red {
    border: 2px solid red;
}
</style>