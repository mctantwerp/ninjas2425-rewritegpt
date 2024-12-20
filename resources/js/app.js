import './bootstrap';

import setupUI from './toggleMenus.js';

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        setupUI();
    });
} else {
    setupUI();
}
