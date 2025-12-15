import './bootstrap';
import './navigation';
import './components/topbar-loader';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

window.Alpine = Alpine;

Alpine.plugin(intersect);

Alpine.start();
