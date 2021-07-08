import { createStore } from 'vuex';
// import coachesModule from './modules/coaches/index';
// import requestsModule from './modules/requests/index.js';
import authModule from './modules/auth/index';
import expensesModule from './modules/expenses/index';

const store = createStore({
    modules: {
        // coaches: coachesModule,
        // requests: requestsModule,
        auth: authModule,
        expenses : expensesModule,
    }
});

export default store;
