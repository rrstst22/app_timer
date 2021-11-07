/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('countdown-component', require('./components/CountDownComponent.vue').default);
Vue.component('holiday-component', require('./components/HolidayComponent.vue').default);
Vue.component('todo-component', require('./components/TodoComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
        return {
            on_arrow: true,
            selected_time: "",
            selected_todo: 0,
            on_modal_mode: false,
            show_room_content: true,
            show_todo: true,
        }  
    },
    mounted() {
        window.addEventListener('resize', this.handleResize); //リサイズ検知
        this.handleResize();
    },
    methods: {
        updateTime: function (selected_time) {
            this.selected_time = selected_time;
        },
        updateTodo: function (selected_todo) {
            this.selected_todo = selected_todo;
        },
        handleResize: function() {
            if (window.innerWidth <= 800) { //画面幅800px以下でモーダルモード
                this.on_modal_mode = true;
                this.show_room_content = false;
                this.show_todo = false;
            } else {
                this.on_modal_mode = false;
                this.show_room_content = true;
                this.show_todo = true;
            }
        },
        openModalTodo: function(){
            this.show_todo = true;
        },
        openModalHoliday: function(){
            this.show_room_content = true;
        },
        closeModalTodo: function(){
            if(this.on_modal_mode){   //モーダル画面表示ではない場合は、画面を閉じない。
              this.show_todo = false;
            }
        },
        closeModal: function(){
            if(this.on_modal_mode){   //モーダル画面表示ではない場合は、画面を閉じない。
              this.show_room_content = false;
            }
        },
    }
});
