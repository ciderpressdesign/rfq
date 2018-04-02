import Vue from 'vue'
import Router from 'vue-router'
import RequestQuote from '../components/RequestQuote'
import MainBox from '../components/forms/MainBox'
import GeneralGameInfo from '../components/forms/GeneralGameInfo'
import Cards from '../components/forms/Cards'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'RequestQuote',
            component: RequestQuote,
            children: [
                {
                    path: 'info',
                    component: GeneralGameInfo
                },
                {
                    path: 'main-box/:id',
                    component: MainBox
                },
                {
                    path: 'cards/:id',
                    component: Cards
                }
            ]
        }
    ]
})
