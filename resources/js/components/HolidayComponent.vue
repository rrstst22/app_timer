<template>
<div class="p-4">
    <div class="text-center"><h3>祝日</h3></div>
    <div class="holiday-box">

        <!-- v-forで祝日一覧を表示 -->
        <div class="border" v-for="(holiday, index) in holidays" v-bind:key="index">

            <!-- 今日の日付を基準にして祝日のボックスの色を変える -->
            <!-- 祝日が今日より後の場合 -->
            <div v-if="compareDate(index)">
                <button class="btn holiday-btn p-3" v-on:click="update(index)">
                    {{ index }}<br>
                    {{ holiday }}
                </button>
            </div>

            <!-- 祝日が今日より前の場合 -->
            <div v-else>
                <button class="btn holiday-btn-passed p-3" v-on:click="update(index)">
                    {{ index }}<br>
                    {{ holiday }}
                </button>
            </div>

        </div>

    </div>
</div>
</template>

<script>
    export default {
        data () {
            return {
                holidays: [],
            }
        },
        mounted() {
            this.getHolidays();
        },
        methods: {
            //選択した祝日を親コンポーネントへ送信
            update: function(selected_holiday) {
                this.$emit('holiday-click', selected_holiday);
                this.closeModal();
            },
            //モーダルウィンドウをクローズ
            closeModal: function() {
                this.$emit('todo-click-c');
            },
            //祝日リストを取得
            getHolidays: function() {
                var self = this;
                axios.get('vue/get-holidays')
                    .then(function(response) {
                        self.holidays = response.data;
                    }).catch(function(error) {
                        alert(error);
                });
            },
            //今日の日付とイベントの日付を比較
            compareDate: function(index) {
                const time = Date.parse(index);
                const now = new Date();

                if(now<=time){
                    return true;
                }else {
                    return false;
                }
            },
        }
    }

</script>

<style scoped>
.holiday-box {
    overflow-y: scroll;
    height: 500px;
    cursor: pointer;
}
.holiday-btn {
    width: 100%;
}
.holiday-btn-passed {
    width: 100%;
    opacity: .4;
}
</style>