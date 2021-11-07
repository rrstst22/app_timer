<template>
    <div class="p-4">
        <div class="text-center"><h3>カウントダウン</h3></div>
        <div class="time-section text-center p-4">
            <div class="p-2">
                <p>{{ selected_name }}まで</p>
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
            selected_time: {
                type: String,
                default: ""
            },
            selected_todo: {
                type: Number,
                default: 0
            }
        },
        data () {
            return {
                selected_time_1: "",
                selected_name: "明日",
                holiday: [],
                countdown_timer: 0,
                todo: []
            }
        },
        watch: {
            selected_time: function() {
                clearTimeout(this.countdown_timer);
                this.getHoliday();
                this.countdown();
            },
            selected_todo: function() {
                clearTimeout(this.countdown_timer);
                this.getTodo();
                this.countdown();
            },
        },
        mounted: function(){
            this.getTomorrow();
        },
        methods: {
            getTomorrow: function() {
                const date = new Date();
                date.setDate(date.getDate() + 1);
                const year  = date.getFullYear();
                const month = date.getMonth() + 1;
                const day   = date.getDate();
                this.selected_time_1 = String(year) + "-" + String(month) + "-" + String(day);
                this.countdown();
            },
            countdown: function() {
                const now=new Date();//今の時間    
                const time = Date.parse(this.selected_time_1);
                const date = new Date(time);
                const differ=date.getTime()-now.getTime();//あと何秒か計算

                const day=Math.floor(differ/1000/60/60/24);
                const hour=Math.floor(differ/1000/60/60)%24;
                const min=Math.floor(differ/1000/60)%60;//1時間=60分だからね
                const sec=Math.floor(differ/1000)%60;//ミリ秒を秒に直してから

                document.getElementById("day").textContent=String(day).padStart(2,"0"); //一桁になった時0がつくように
                document.getElementById("hour").textContent=String(hour).padStart(2,"0"); //一桁になった時0がつくように
                document.getElementById("min").textContent=String(min).padStart(2,"0");
                document.getElementById("sec").textContent=String(sec).padStart(2,"0");
                this.countdown_timer = window.setTimeout(this.countdown,1000);//1秒毎に繰り返す
            },
            getHoliday: function() {
                var self = this;
                axios.get('get-holiday', {params:{date: this.selected_time}})
                    .then(function(response){
                        self.holiday = response.data;
                        self.selected_time_1 = self.selected_time
                        self.selected_name = self.holiday.name
                    }).catch(function(error){
                        alert(error);
                });
            },
            getTodo: function() {
                var self = this;
                axios.get('get-todo', {params:{id: this.selected_todo}})
                    .then(function(response){
                        self.todo = response.data;
                        console.log(response.data[0].name);
                        self.selected_time_1 = response.data[0].date;
                        self.selected_name = response.data[0].name;
                    }).catch(function(error){
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
.holiday-box {
    overflow-y: scroll;
    height: 500px;
    cursor: pointer;
}
.holiday {
    width: 100%;
}
</style>