import { createApp, defineAsyncComponent } from 'vue';

//Main pages
import App from './views/App.vue'
import router from './router.js';
import store from './store/index';
const app = createApp(App);

// Global Components import
import BaseBadge from "./components/ui/BaseBadge";
import BaseDialog from "./components/ui/BaseDialog";
import BaseButton from "./components/ui/BaseButton";
import BaseSpinner from  './components/ui/BaseSpinner';
import BaseCard from  './components/ui/BaseCard';

// Global Components mount - we can and will use this components all across our app
app.component('base-card', BaseCard); // register component globally in our app
app.component('base-button', BaseButton);
app.component('base-badge', BaseBadge);
app.component('base-spinner', BaseSpinner);
app.component('base-dialog', BaseDialog);

// Route navigation & Protection through our app
app.use(router);

// Vuex Store
app.use(store);

// Lunch App
app.mount('#app');
