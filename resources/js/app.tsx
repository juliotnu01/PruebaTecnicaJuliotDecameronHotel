import '../css/app.css';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';
import { initializeTheme } from './hooks/use-appearance';
import { ToastContainer } from 'react-toastify'; // Importar ToastContainer
import 'react-toastify/dist/ReactToastify.css'; // Importar estilos de react-toastify

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.tsx`, import.meta.glob('./pages/**/*.tsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);

        // Envolver la aplicación con un fragmento que incluya ToastContainer
        root.render(
            <>
                <App {...props} />
                <ToastContainer /> 
            </>
        );
    },
    progress: {
        color: '#4B5563',
    },
});

// Esto establecerá el tema claro/oscuro al cargar...
initializeTheme();