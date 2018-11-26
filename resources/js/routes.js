import Dashboard from './components/dashboard/dashboard'
import listUsers from './components/dashboard/users/listUsers'
import listSites from './components/dashboard/sites/listSites'

const routes = [
    { path: '/', component: Dashboard },
    { path: '/users', component: listUsers },
    { path: '/sites', component: listSites },


];

export default routes;