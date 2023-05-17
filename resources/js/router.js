import { createWebHistory, createRouter, createRouterMatcher } from "vue-router";

const routes = [
    {
        path: '/users', component: ()=> import('./components/Fruit/Index.vue'), name:'fruit.index'
    },
    {
        path: '/quests', component: ()=> import('./components/Quest/Index.vue'), name:'quest.index'
    },
    {
        path: '/quests', component: ()=> import('./components/Team/Index.vue'), name:'team.index'
    },
    {
        path: '/quests/start', component: ()=> import('./components/Quest/Start.vue'), name:'quest.start'
    },
    {
        path: '/users/login', component: ()=> import('./components/User/Login.vue'), name:'user.login'
    },
    {
        path: '/users/registration', component: ()=> import('./components/User/Registration.vue'), name:'user.registration'
    },
    {
        path: '/users/personal', component: ()=> import('./components/User/Personal.vue'), name:'user.personal'
    },

    {
        path: '/#', component: ()=> import('./components/User/Personal.vue'), name:'404'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to,from,next)=>{

    const accessToken = localStorage.getItem('access_token');
    // console.log(accessToken);
    if(!accessToken){
    if(to.name ==='user.login'||to.name ==='user.registration'){
            return next()
        }
        else{
            return next({name: 'user.login'})
        }
    }

    if(to.name ==='user.login'||to.name ==='user.registration'){
        if(accessToken){
            return next({name: 'user.personal'})
        }
    }

    next();
});

export default router;
