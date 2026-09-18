/**
 * ==========================================================
 * THEME TOGGLE
 * Alterna entre tema claro y oscuro guardando la preferencia
 * en localStorage. Aplica el atributo data-theme en <html>,
 * que es lo que leen las variables CSS de nutriadmin.css
 * (y de landing.css / login.css).
 *
 * El botón puede repetirse varias veces en la misma página
 * (ej. versión desktop + versión móvil) — todas se sincronizan.
 * ==========================================================
 */

(function () {

    const STORAGE_KEY = 'nutriadmin-theme';

    function getStoredTheme() {
        try {
            return localStorage.getItem(STORAGE_KEY);
        } catch (e) {
            return null;
        }
    }

    function storeTheme(theme) {
        try {
            localStorage.setItem(STORAGE_KEY, theme);
        } catch (e) {
            /* localStorage no disponible (modo privado, etc.) — no pasa nada */
        }
    }

    function systemPrefersLight() {
        return window.matchMedia &&
            window.matchMedia('(prefers-color-scheme: light)').matches;
    }

    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);

        /* AdminLTE 4 usa el sistema nativo de Bootstrap 5.3 (data-bs-theme)
           para su propio navbar/sidebar. Lo sincronizamos con nuestro tema
           para que .app-header y .app-sidebar también cambien. */
        document.documentElement.setAttribute('data-bs-theme', theme);

        /* AdminLTE fija data-bs-theme="dark" directamente en el <aside
           class="app-sidebar">, lo cual PISA el atributo de <html>. Hay
           que sobreescribirlo también ahí, específicamente. */
        const sidebar = document.querySelector('.app-sidebar');
        if (sidebar) {
            sidebar.setAttribute('data-bs-theme', theme);
        }

        document.querySelectorAll('[data-theme-toggle]').forEach(function (button) {
            const icon = button.querySelector('[data-theme-icon]');
            const label = button.querySelector('[data-theme-label]');

            if (icon) {
                icon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
            }

            if (label) {
                label.textContent = theme === 'light' ? 'Oscuro' : 'Claro';
            }

            button.setAttribute(
                'aria-label',
                theme === 'light' ? 'Cambiar a tema oscuro' : 'Cambiar a tema claro'
            );
        });
    }

    function currentTheme() {
        return document.documentElement.getAttribute('data-theme') === 'light'
            ? 'light'
            : 'dark';
    }

    function toggleTheme() {
        const next = currentTheme() === 'light' ? 'dark' : 'light';
        applyTheme(next);
        storeTheme(next);
    }

    // Init: localStorage > preferencia del sistema > oscuro (default de marca)
    const initial = getStoredTheme() || (systemPrefersLight() ? 'light' : 'dark');
    applyTheme(initial);

    document.addEventListener('DOMContentLoaded', function () {
        applyTheme(currentTheme());

        document.querySelectorAll('[data-theme-toggle]').forEach(function (button) {
            button.addEventListener('click', toggleTheme);
        });
    });

})();
