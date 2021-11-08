<template>
    <div class="p-4">
        <div class="text-center"><h3>カウントダウン</h3></div>
        <div class="time-section text-center p-4">
            <div class="p-2">
                <p>{{ target_event }}まで</p>
                <p>あと</p>
            </div>
            <div class="time-box p-4">
                <p><span id="day"></span>日と</p>
                <p><span id="hour"></span>時間<span id="min"></span>分<span id="sec"></span>秒</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            selected_todo: {
                type: Number,
                default: 0
            },
            selected_holiday: {
                type: String,
                default: ""
            },
        },
        data () {
            return {
                target_time: "",
                target_event: "明日",
                holiday: [],
                todo: [],
                countdown_timer: 0, //カウントダウンストップ用
            }
        },
        watch: {
            //Todoのクリックを検知
            selected_todo: function(selected_todo) {
                if(selected_todo != 0) {
                    clearTimeout(this.countdown_timer);
                    this.getTodo();
                    this.countdown();
                }
            },
            //祝日のクリックを検知
            selected_holiday: function(selected_holiday) {
                if(selected_holiday != "") {
                    clearTimeout(this.countdown_timer);
                    this.getHoliday();
                    this.countdown();
                }
            },
        },
        mounted: function() {
            this.getTomorrow(); //初期表示（明日）
        },
        methods: {
            //カウントダウン
            countdown: function() {
                const now = new Date();
                const time = Date.parse(this.target_time); //文字列型からdatetime型へ変換
                const date = new Date(time);
                const differ=date.getTime()-now.getTime();

                //日、時、分、秒の値を計算
                let day = Math.floor(differ/1000/60/60/24);
                const hour = Math.floor(differ/1000/60/60)%24;
                const min = Math.floor(differ/1000/60)%60;
                const sec = Math.floor(differ/1000)%60;

                if(day < 0) {
                    day = day + 1; //マイナスの場合一日ずれるので+1
                }

                //一桁になった時に0を付与
                document.getElementById("day").textContent=String(day).padStart(2,"0"); 
                document.getElementById("hour").textContent=String(hour).padStart(2,"0"); 
                document.getElementById("min").textContent=String(min).padStart(2,"0");
                document.getElementById("sec").textContent=String(sec).padStart(2,"0");

                this.countdown_timer = window.setTimeout(this.countdown,1000);
            },
            //明日の日付を取得
            getTomorrow: function() {
                const date = new Date();
                date.setDate(date.getDate() + 1); //dateを明日にセット

                //datetime型を文字列へ変換
                const year  = date.getFullYear();
                const month = date.getMonth() + 1;
                const day   = date.getDate();
                this.target_time = String(year) + "-" + String(month) + "-" + String(day);

                this.countdown();
            },
            //Todo一覧を取得
            getTodo: function() {
                var self = this;
                axios.get('vue/get-todo', {params:{id: this.selected_todo}})
                    .then(function(response) {
                        self.todo = response.data;
                        self.target_time = response.data[0].date;
                        self.target_event = response.data[0].name;
                    }).catch(function(error) {
                        alert(error);
                });
            },
            //祝日一覧を取得
            getHoliday: function() {
                var self = this;
                axios.get('vue/get-holiday', {params:{date: this.selected_holiday}})
                    .then(function(response) {
                        self.holiday = response.data;
                        self.target_time = self.selected_holiday;
                        self.target_event = self.holiday.name;
                    }).catch(function(error) {
                        alert(error);
                });
            },
        }
    }

</script>

<style scoped>
.time-section {
    font-size: 1.3rem;
}
.time-box {
    padding: 0.5em 1em;
    margin: 2em 0;
    color: #5989cf;
    background: #c6e4ff;
    border-bottom: solid 6px #fffff0;
    border-radius: 9px;
}
.time-box p {
    margin: 0; 
    padding: 0;
}
</style>