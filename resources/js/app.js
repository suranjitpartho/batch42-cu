import './bootstrap';
import './navigation';
import './components/topbar-loader';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

Alpine.plugin(intersect);

window.Alpine = Alpine;

Alpine.start();
