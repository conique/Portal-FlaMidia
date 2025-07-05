// resources/js/app.js

import './bootstrap'; // Este já está lá pelo Breeze para algumas coisas do Laravel

import Alpine from 'alpinejs'; // Importa o Alpine.js
window.Alpine = Alpine;
Alpine.start();

// <<< ESTA LINHA IMPORTA O JAVASCRIPT DO BOOTSTRAP >>>
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap; // Torna global se precisar, mas não é estritamente necessário

// Seu JavaScript personalizado para o frontend
// console.log('Frontend JavaScript loaded!');