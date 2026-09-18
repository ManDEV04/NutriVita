# NutriVita — Reorganización de vistas, CSS y JS

Este zip contiene TODAS las vistas de `resources/views` reorganizadas:
CSS movido a `resources/css/nutriadmin.css` (una sola sección por página,
claramente comentada), JS movido a `resources/js/` (uno por página), y
partials creados donde el archivo era demasiado grande para mantenerlo
en un solo bloque.

## ⚠️ Antes de copiar los archivos a tu proyecto

1. **Reemplaza tu `vite.config.js`** por el de este zip — agrega todas
   las entradas JS nuevas al arreglo `input`. Sin esto, cualquier
   `@vite([...])` de las vistas nuevas va a tronar con
   `ViteManifestNotFoundException`.
2. Corre `npm run build` (o `npm run dev` mientras programas).
3. Copia `resources/views/*`, `resources/css/nutriadmin.css`,
   `resources/js/*` y `web.php` a tu proyecto, sobrescribiendo.

## Qué cambió, por módulo

### Dashboard (ya lo tenías validado)
- `dashboard/index.blade.php` + 7 partials (header, hero, metrics, charts,
  summary, quick-actions, footer)
- JS en `resources/js/dashboard.js`

### Pacientes (`patients/`)
- `index.blade.php` → partials `hero`, `stats`, `toolbar`, `list`
- `create.blade.php` → partials `create-form`, `create-sidebar`
- `edit.blade.php` → partials `edit-form`, `edit-preview`
- `show.blade.php` → 6 partials (hero, info-grid, latest-evaluation,
  progress, chart, history)
- JS: `patients-index.js`, `patients-create.js`, `patients-edit.js`,
  `patients-show.js` (esta última usa gráficas de Chart.js)

### Citas (`appointments/`)
- `index.blade.php` → partials `index-hero`, `index-stats`,
  `index-calendar` (calendario interactivo completo)
- `create.blade.php` → partials `create-form`, `create-sidebar`
- JS: `appointments-index.js` (721 líneas — el calendario), `appointments-create.js`

### Consultas (`consultations/`)
- `index.blade.php` — tamaño razonable, sin partials, solo CSS extraído
- `create.blade.php` — **este NUNCA tuvo su propio `<style>`** en el
  original (solo usaba Bootstrap plano: `card`, `form-control`, `btn-light`).
  A tu pedido, le di el mismo look "glass" que las demás vistas del
  módulo, reutilizando las clases ya existentes (`form-glass-card`,
  `liquid-input`, `liquid-select`, `liquid-textarea`, `section-label`,
  `form-actions`, etc. — definidas en la sección de PACIENTES — CREATE).
  Solo agregué 2 clases nuevas y pequeñas (`.consultation-form-page`,
  `.field-hint`) y un JS mínimo para los contadores de caracteres
  (`consultations-create.js`).
- **Nota:** a estas dos les faltaba el `<link>` de FontAwesome (el mismo
  bug que vimos en el dashboard). Ya se lo agregué.

### Pagos (`payments/`)
- `index.blade.php`, `create.blade.php` — igual, sin partials, CSS extraído
- Les agregué el link de Google Fonts que no tenían

### Evaluaciones (`evaluations/`)
- `create.blade.php` → partials `create-form`, `create-sidebar`
- JS: `evaluations-create.js` (vista previa + cálculo de IMC en vivo)

### Progreso (`progress/`)
- `index.blade.php` → partials `index-stats`, `index-patients`
- `show.blade.php` — CSS/JS extraído, `progress-show.js` con las gráficas
  de peso y composición corporal

### Landing / Marketing / Auth
- `landing/index.blade.php` — **sin cambios**, ya usaba
  `asset('css/landing.css')` externo (no vive en `nutriadmin.css`, es un
  sistema de diseño aparte)
- **Encontré `landing/index.blade-2.php`** — un archivo con extensión
  inválida para Blade (Laravel nunca lo carga como vista). Parece un
  borrador tuyo con decoraciones extra (aguacate, verduras, etc.) que no
  llegó a integrarse. Lo incluyo como `index.blade-2.php.bak` sin tocarlo
  — revisa si lo necesitas o lo puedes borrar.
- `layouts/marketing.blade.php` — el script inline (menú móvil + navbar
  al hacer scroll) ahora vive en `resources/js/pages/marketing.js`
- `auth/login.blade.php` — el script de mostrar/ocultar contraseña ahora
  vive en `resources/js/pages/auth-login.js`

## El patrón usado para JS con datos de Blade

Cuando un script necesitaba datos del servidor (`@json($variable)`,
`{{ $algo }}`), separé:
- Un `<script>` pequeño **dentro del blade** que solo arma
  `window.xxxData = { ... }` con esos datos.
- El archivo `.js` real, que lee de `window.xxxData` y no contiene
  ninguna sintaxis de Blade — así sí puede vivir en Vite sin problema.

Esto aplica en: `dashboard.js`, `patients-show.js`,
`appointments-index.js`, `progress-show.js`.

## Nota sobre el CSS

`nutriadmin.css` quedó grande (una sección completa por página, todas
comentadas con su nombre). **No deduplico** reglas repetidas entre
páginas (por ejemplo el `body { background: ... }` aparece varias
veces, una por sección) — preferí no arriesgar romper el diseño de
ninguna vista. Si más adelante quieres que consolide esas reglas
repetidas en una sola sección "global", dime y lo hacemos con cuidado,
viendo cada página.

## Todos los archivos pasaron chequeos de sanidad

- CSS: llaves `{`/`}` balanceadas (1132 = 1132)
- Todos los `.js` nuevos: sintaxis válida (`node --check`)
- Todos los `.blade.php`: `@section`/`@stop`, `@if`/`@endif`,
  `@foreach`/`@endforeach` balanceados
