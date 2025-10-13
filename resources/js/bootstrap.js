import axios from 'axios';

// // template
// import '../template/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js';
// import '../template/assets/js/bootstrap.bundle.min.js'
// import '../template/assets/js/pages/dashboard.js';
// import '../template/assets/js/main.js';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

