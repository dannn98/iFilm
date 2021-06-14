import { createRouter, createWebHistory } from "vue-router";
import HomeView from '@/views/HomeView';
import MovieView from '@/views/MovieView';
import LoginView from '@/views/LoginView';
import RegisterView from '@/views/RegisterView';
import ToWatchView from '@/views/ToWatchView';
import WatchedView from '@/views/WatchedView';
import RanksView from '@/views/RanksView';
import SearchView from '@/views/SearchView';

const routes = [
    {
        path: '/',
        name: 'Default',
        component: HomeView,
        meta: {
            title: 'Home - iFilm'
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: LoginView,
        meta: {
            title: 'Sign in - iFilm'
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: RegisterView,
        meta: {
            title: 'Sign up - iFilm'
        }
    },
    {
        path: '/home',
        name: 'Home',
        component: HomeView,
        meta: {
            title: 'Home - iFilm'
        }
    },
    {
        path: '/home/:page',
        name: 'HomePage',
        component: HomeView,
        meta: {
            title: 'Home - iFilm'
        }
    },
    {
        path: '/movie/:id',
        name: 'MoviePage',
        component: MovieView,
        meta: {
            title: 'Movie - iFilm'
        }
    },
    {
        path: '/search/:key',
        name: 'SearchPage',
        component: SearchView,
        meta: {
            title: 'Search - iFilm'
        }
    },
    {
        path: '/towatch',
        name: 'ToWatch',
        component: ToWatchView,
        meta: {
            title: 'To watch - iFilm'
        }
    },
    {
        path: '/watched',
        name: 'Watched',
        component: WatchedView,
        meta: {
            title: 'Watched - iFilm'
        }
    },
    {
        path: '/ranks',
        name: 'Ranks',
        component: RanksView,
        meta: {
            title: 'Ranks - iFilm'
        }
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

const publicPages = ['/login', '/register'];

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    const authRequired = !publicPages.includes(to.path);
    const hasToken = localStorage.getItem('token');

    if(authRequired && !hasToken){
        return next('/login');
    }
    next();
});

export default router;