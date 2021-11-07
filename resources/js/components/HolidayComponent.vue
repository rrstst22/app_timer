<template>
<div class="p-4">
    <div class="text-center"><h3>祝日</h3></div>
    <div class="holiday-box">
        <div class="border" v-for="(holiday, index) in holidays" v-bind:key="index">
            <div v-if="getNow(index)">
                <button class="btn holiday p-3" v-on:click="update(index)">
                    {{ index }}<br>
                    {{ holiday }}
                </button>
            </div>
            <div v-else>
                <button class="btn holiday-passed p-3" v-on:click="update(index)">
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
                selected_time: "2021-11-07",
            }
        },
        mounted() {
            this.getHoliday();
        },
        methods: {
            update: function(selected_time) {
                this.selected_time = selected_time;
                this.$emit('holiday-click', selected_time);
            },
            getNow: function(index) {
                const time = Date.parse(index);
                const now = new Date();
                if(now<=time){
                    return true;
                }else {
                    return false;
                }
            },
            getHoliday: function() {
                var self = this;
                axios.get('get-holidays')
                    .then(function(response){
                        self.holidays = response.data;
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
.holiday-passed {
    width: 100%;
    opacity: .4;
}
</style>