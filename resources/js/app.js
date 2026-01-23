import '../css/app.css';
import './bootstrap';

// template
import '../template/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js';
import '../template/assets/js/bootstrap.bundle.min.js'
import '../template/assets/js/pages/dashboard.js';
import '../template/assets/js/main.js';
import '../template/assets/vendors/ckeditor/ckeditor.js';

// landing Page js
import '../templateLandingPage/vendor/bootstrap/js/bootstrap.bundle.min.js';
import '../templateLandingPage/vendor/php-email-form/validate.js';
import '../templateLandingPage/vendor/swiper/swiper-bundle.min.js';
// import '../templateLandingPage/vendor/aos/aos.js';
import '../templateLandingPage/vendor/glightbox/js/glightbox.min.js';
import '../templateLandingPage/vendor/drift-zoom/Drift.min.js';
import '../templateLandingPage/vendor/purecounter/purecounter_vanilla.js';

import '../templateLandingPage/js/main.js';
/////*************** */
import { createInertiaApp, router } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import AOS from 'aos';
import 'aos/dist/aos.css'; 

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app =  createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue);

        app.mount(el);
        /** AOS  es para la plantilla landing page */
        // 2. Inicializa AOS
        AOS.init({
            duration: 1000,
            once: true,
        });

        return app;
    },
    progress: {
        color: '#4B5563',
    },
});
// 3. ESTO ES VITAL: Refresca AOS en cada cambio de página de Inertia
router.on('finish', () => {
    AOS.refresh();
});




