<template>
    <div class="row">
        <div class="col-md-8">
            <div class="time-box text-center p-4">
                <p class="until">{{ selected_name }}まで</p>
                <p class="timer">あと
                <span id="day"></span>日と
                <span id="hour"></span>時間
                <span id="min"></span>分
                <span id="sec"></span>秒
                </p>
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
                selected_name: "　",
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
        methods: {
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