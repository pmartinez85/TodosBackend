
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    data: {
        message: 'Hello Vue!',
        seen: false,
        todos: [
            { name: 'Learn Javascript',
                done: true,
                priority: 4
            },
            { name: 'Learn PHP',
                done: false,
                priority: 5
            },
            { name: 'Buy bread',
                done: false,
                priority: 1
            }
        ]
    },
    methods: {
        reverseMessage:function () {
            this.message = this.message.split('').reverse().join('');

        },
        fetchData:function () {
            //xhr
            //axios
            var req = new XMLHttpRequest();
            req.open('GET', 'http://localhost:8082/api/v1/task', true);
            req.onreadystatechange = function (aEvt) {
                if (req.readyState == 4) {
                    if(req.status == 200)
                        dump(req.responseText);
                }
            };
        }
    },
    created: function(){
        console.log('App created');
        this.fetchData()
    }
});

