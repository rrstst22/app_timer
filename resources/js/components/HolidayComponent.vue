<template>
    <div class="holiday-box">
        <div class="border" v-for="(holiday, index) in holidays" v-bind:key="index">
            <button class="btn holiday p-4" v-on:click="update(index)">{{ index }} {{ holiday }}</button>
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
</style>