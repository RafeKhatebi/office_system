import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";
import './bootstrap'; // Uncomment if you have bootstrap or other initializations
import '../css/app.css'; // Uncomment if you have global CSS
// import css styles or other assets as needed
import '../../public/assets/styles/tailwind.css';
createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true });
        return pages[`./Pages/${name}.jsx`];
    },
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
    
});
