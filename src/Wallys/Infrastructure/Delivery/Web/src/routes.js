import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',

        component: require('./views/Home.vue').default
    },
];

let router = new VueRouter({routes});

export default router;
