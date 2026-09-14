{{-- =========================================================
     THEME INIT (anti-parpadeo)
     Pega esto en el <head>, ANTES de los <link> de CSS, en
     TODOS los layouts (marketing.blade.php, login, adminlte,
     layouts/app.blade.php...). Es un script mínimo y síncrono:
     lee localStorage y pone data-theme en <html> antes de que
     el navegador pinte la página, para que nunca se vea un
     flash del tema equivocado.
     ========================================================= --}}
<script>
    (function () {
        try {
            var theme = localStorage.getItem('nutriadmin-theme');
            if (!theme) {
                theme = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches
                    ? 'light'
                    : 'dark';
            }
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.setAttribute('data-bs-theme', theme);
        } catch (e) {
            document.documentElement.setAttribute('data-theme', 'dark');
            document.documentElement.setAttribute('data-bs-theme', 'dark');
        }
    })();
</script>
