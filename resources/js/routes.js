import Dashboard from './components/dashboard/dashboard'
import listUsers from './components/dashboard/users/listUsers'
import listSites from './components/dashboard/sites/listSites'
import addSites from './components/dashboard/sites/addSite';

import Loader_addsite from './components/dashboard/sites/loader';

const routes = [
    { path: '/', component: Dashboard },
    { path: '/users', component: listUsers },
    { path: '/sites', component: listSites },
    { path: '/sites/add', component: Loader_addsite },


];

export default routes;